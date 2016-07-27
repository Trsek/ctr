<?php
require_once("struct/ctr_frame.inc");
require_once("obj/objects.inc");
require_once("funct/funct_name.php");
require_once("struct/struct_name.php");
require_once("obj/objects.php");


/********************************************************************
* @brief Remove 0A/0D if have it. Remove SMS prefix if have it
*/
function CTR_NORMALIZE($SMS)
{
	// strip all spaces
	$SMS = str_replace(' ', '', $SMS);
	$SMS = str_replace("\r", '', $SMS);
	$SMS = str_replace("\n", '', $SMS);
	
	// strip 0A/0D
	if((strtoupper (substr($SMS,0,2)) == '0A')
	&& (strtoupper (substr($SMS,strlen($SMS)-2,2)) == '0D'))
	{
		$SMS = substr($SMS, 2, strlen($SMS)-4);
	}
	
	// strip SMS prefix
	$poz = strpos(strtoupper($SMS), "8C");
	if(( strlen($SMS) > 284 )
	&& ( $poz < 58 ))
	{
		$SMS = substr($SMS, $poz+2, strlen($SMS)-$poz);
	}

	return $SMS;
}

/********************************************************************
 * @brief Added space every $len
 */
function add_soft_space($DATI, $len)
{
	$asnwer = "";
	while( strlen($DATI))
	{	
		$answer .= substr($DATI, 0, $len) ." ";
		$DATI = substr($DATI, $len, strlen($DATI));
	}   

	return $answer;
}

/********************************************************************
* @brief Make HTML format from array
* @retval HTML format divide by <br>
*/
function ctr_array_show($value)
{
	if( is_array($value) && count($value)==1)
		$value = $value[0];
	
	if( !is_array($value))
	{
		$space = "";
		while($value[0] == ' ')
		{
			$space .= "&nbsp;";
			$value = substr($value, 1, strlen($value));
		}
		return $space. $value;
	}

	$out = "";
	foreach ($value as $value_line)
	{
		$out .= ctr_array_show($value_line) . "<br>";
	}
	return $out;
}

/********************************************************************
* @brief Show analyze SMS
* @retval HTML table format
*/
function ctr_show($SMS)
{
	$SMS_FRAME = ctr_analyze_frame($SMS);

	$out  = "<table class='table-style-two'>";
	foreach ($SMS_FRAME as $name => $value)
	{
		$out .= "<tr>";
		$out .= "<td>". $name ."</td>";
		$out .= "<td>";
		$out .= ctr_array_show($value);
		$out .= "</td>";
		$out .= "</tr>";
	}
	$out .= "</table>";
	
	return $out;
}

/********************************************************************
* @brief Analyze profi byte
*/
function ctr_profi($profi)
{
	$profile_text = 
		array('A-metrolog',	 // 0
              'A-maintenance', // 1
              'B-user1',     // 2
              'C-user2',     // 3
              'D-user3',     // 4
              '',            // 5
		      '',            // 6
              'secret');     // 7

	$answer[] = dechex($profi) ."h";
	
	if( $profi & 0x80)
		$answer[] = 'long frame';
	
	$answer[] = (string)(($profi >> 3) & 0x0F) . " - operator (0-admin)";
	$answer[] = (string)($profi & 0x07) . " - profile (" .$profile_text[$profi & 0x07] .")";
	return $answer;
}

/********************************************************************
* @brief Analyze funct byte
*/
function ctr_funct($funct)
{
	global $funct_code;
	$encrypt_text = 
		array('00 - not encrypted',
		      '01 - encrypted use KEYC',
		      '10 - encrypted use KEYT - temporary',		
	          '11 - encrypted use KEYF - factory');
	
	$answer[] = dechex($funct) ."h";
	$answer[] = ctr_funct_name($funct & 0x3F);
	$answer[] = $encrypt_text[ $funct >> 6 ];
	return $answer;
}

/********************************************************************
* @brief Metaanalyze frame name
*/
function ctr_analyze_frame(&$SMS)
{
	$SMS_DATI['ADD']   = substr_cut($SMS, 2);
	$SMS_DATI['PROFI'] = substr_cut($SMS, 1);
	$SMS_DATI['FUNCT'] = substr_cut($SMS, 1);
	$SMS_DATI['STRUCT']= substr_cut($SMS, 1);
	$SMS_DATI['CHAN']  = substr_cut($SMS, 1) ."h";
	$SMS_DATI['DATI']  = substr_cut($SMS, 128);
	$SMS_DATI['CPA']   = substr_cut($SMS, 4);
	$SMS_DATI['CRC']   = substr_cut($SMS, 2);

	$sms_funct  = hexdec( $SMS_DATI['FUNCT']) & 0x3F;
	$sms_struct = hexdec( $SMS_DATI['STRUCT']);
	
	$SMS_DATI['PROFI']  = ctr_profi( hexdec( $SMS_DATI['PROFI']));
	$SMS_DATI['FUNCT']  = ctr_funct( hexdec( $SMS_DATI['FUNCT']));
	$SMS_DATI['STRUCT'] = ctr_struct_name( hexdec( $SMS_DATI['STRUCT']));
	$SMS_DATI['DATI']   = ctr_dati( $SMS_DATI['DATI'], $sms_funct, $sms_struct);
	
	return $SMS_DATI;
}

/********************************************************************
* @brief Analyze data part
*/
function ctr_dati($DATI, $sms_funct, $sms_struct)
{
	$answer = $DATI;
	switch ( $sms_funct )
	{
		case CTR_ACK:
			require_once 'struct/2D-nack.php';
			$answer = ctr_ack($DATI);
			break;
			
		case CTR_NACK:
			require_once 'struct/2D-nack.php';
			$answer = ctr_nack($DATI);
			break;
				
		case CTR_QUERY:
		switch( $sms_struct )
		{
			case CTR_STR_REGISTER:
				require_once 'struct/50-register.php';
				$answer = ctr_Query($DATI);
				break;

			case CTR_STR_ARRAY:
				require_once 'struct/51-array.php';
				$answer = ctr_Query($DATI);
				break;
				
			case CTR_STR_TRACE:
				require_once 'struct/52-trace.php';
				$answer = ctr_Query($DATI);
				break;
				
			case CTR_STR_TRACE_C:
				require_once 'struct/53-trace_c.php';
				$answer = ctr_Query($DATI);
				break;

			case CTR_STR_OPTIONAL:
				require_once 'struct/54-optional.php';
				$answer = ctr_Query($DATI);
				break;
				
			case CTR_STR_SCHEMA:
				require_once 'struct/55-trama.php';
				$answer = ctr_Query($DATI);
				break;
				
			case CTR_STR_EVENT:
				require_once 'struct/56-event.php';
				$answer = ctr_Query($DATI);
				break;
				
			case CTR_STR_TRIGGER_EVENT:
				require_once 'struct/f1-event_trigger.php';
				$answer = ctr_Query($DATI);
				break;
				
			case CTR_STR_IDENTIF:
			case CTR_STR_IDENTIF2:
				require_once 'struct/30-identification.php';
				$answer = ctr_Query($DATI, $sms_struct);
				break;

			default:
				if(( $sms_struct >= CTR_STR_TABLE_STRUCT )
				&& ( $sms_struct < CTR_STR_REGISTER ))
				{
					require_once("struct/ctr_frame.php");
					$answer = ctr_Query2($DATI);
					break;
				}		
		}
		break;
		
		case CTR_ANSWER:
		case CTR_VOLUNTARY:
			switch( $sms_struct )
			{
				case CTR_STR_REGISTER:
					require_once 'struct/50-register.php';
					$answer = ctr_Answer($DATI);
					break;

				case CTR_STR_ARRAY:
					require_once 'struct/51-array.php';
					$answer = ctr_Answer($DATI);
					break;
							
				case CTR_STR_TRACE:
					require_once 'struct/52-trace.php';
					$answer = ctr_Answer($DATI);
					break;

				case CTR_STR_TRACE_C:
					require_once 'struct/53-trace_c.php';
					$answer = ctr_Answer($DATI);
					break;

				case CTR_STR_OPTIONAL:
					require_once 'struct/54-optional.php';
					$answer = ctr_Answer($DATI);
					break;

				case CTR_STR_SCHEMA:
					require_once 'struct/55-trama.php';
					$answer = ctr_Answer($DATI);
					break;

				case CTR_STR_EVENT:
					require_once 'struct/56-event.php';
					$answer = ctr_Answer($DATI);
					break;
						
				case CTR_STR_TRIGGER_EVENT:
					require_once 'struct/f1-event_trigger.php';
					$answer = ctr_Answer($DATI);
					break;
						
				case CTR_STR_IDENTIF:
				case CTR_STR_IDENTIF2:
					require_once 'struct/30-identification.php';
					$answer = ctr_Answer($DATI, $sms_struct);
					break;
			
				default:
					if(( $sms_struct >= CTR_STR_TABLE_STRUCT )
					&& ( $sms_struct < CTR_STR_REGISTER ))
					{
						require_once("struct/ctr_frame.php");
						$answer = ctr_parse_frame($DATI, $sms_struct);
						break;
					}		
			}
			break;

		case CTR_EXECUTE:
			require_once 'struct/26-execute.php';
			$answer = ctr_Execute($DATI);
			break;
					
		case CTR_WRITE:
			switch( $sms_struct )
			{
				case CTR_STR_REGISTER:
					require_once 'struct/2f-write.php';
					$answer = ctr_Write($DATI);
					break;
					
				default:
					if(( $sms_struct >= CTR_STR_TABLE_STRUCT )
					&& ( $sms_struct < CTR_STR_REGISTER ))
					{
						require_once("struct/2f-write.php");
						$answer = ctr_Write_Table($DATI, $sms_struct);
						break;
					}
			}
			break;

		case CTR_SECRET:
			require_once 'struct/23-secret.php';
			$answer = ctr_Write($DATI);
			break;


		case CTR_DOWNLOAD:
			require_once 'struct/24-download.php';
			$answer = ctr_Write($DATI);
			break;
						
		case CTR_END:
			break;
					
		case CTR_IDENTIF:
			require_once 'struct/30-identification.php';
			$answer = ctr_Query($DATI, $sms_struct);
			break;

		case CTR_IDENTIF_ANSW:
			require_once 'struct/30-identification.php';
			$answer = ctr_Answer($DATI, $sms_struct);
			break;

	}

	if( is_array($answer))
		$answer[] = add_soft_space($DATI, 64);
	else
		$answer = add_soft_space($DATI, 64);
	
	return $answer;
}
/*----------------------------------------------------------------------------*/
/* END OF FILE */
