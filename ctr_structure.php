<?php
require_once("aes/aes.php");
require_once("struct/ctr_frame.inc");
require_once("crc/crc.php");
require_once("obj/objects.inc");
require_once("funct/funct_name.php");
require_once("struct/struct_name.php");
require_once("obj/objects.php");

define("CPA_ZERO", "00000000");
define("SMS_PREFIX", "8C");
define("SMS_SIZE", 140);
define("SMS_SIZE_LONG", 1024);

/********************************************************************
* @brief Remove 0A/0D if have it. Remove SMS prefix if have it
*/
function CTR_NORMALIZE($SMS)
{
	$SMS = strtoupper($SMS);
	
	// strip all spaces
	$SMS = str_replace(' ', '', $SMS);
	$SMS = str_replace("\r", '', $SMS);
		
	foreach (explode("\n", $SMS) as $SMS_LINE)
	{
		// strip 0A/0D
		if((substr($SMS_LINE,0,2) == '0A')
		&& (substr($SMS_LINE,strlen($SMS_LINE)-2,2) == '0D'))
		{
			$SMS_LINE = substr($SMS_LINE, 2, strlen($SMS_LINE)-4);
		}
	
		// strip SMS prefix
		$poz = strpos($SMS_LINE, SMS_PREFIX);
		if(( strlen($SMS_LINE) > 284 )
		&& ( $poz < 58 )
		&& ( is_numeric($poz)))
		{
			$SMS_LINE = substr($SMS_LINE, $poz+2, strlen($SMS_LINE)-$poz);
		}
		
		// align to minimal size
		if(( strlen($SMS_LINE) > 0 ) 
		&& ( strlen($SMS_LINE)/2 < SMS_SIZE )
		&& ( substr($SMS_LINE, 6, 2) != CTR_ELGAS_HEX ))
		{
			$SMS_LINE .=  str_repeat("00", SMS_SIZE - strlen($SMS_LINE)/2);
		}
	
		if( strlen($SMS_LINE))
			$SMS_OUT .= (strlen($SMS_OUT)? "\n": "") .$SMS_LINE;
	}
	
	return $SMS_OUT;
}

/********************************************************************
 * @brief Check if need decrypt packet
 */
function ctr_IsEncrypt($SMS)
{
	$funct = hexdec( substr($SMS, 6, 2));
	$cpa   = substr($SMS, 268, 8);
	return ($funct >> 6) && ($cpa != CPA_ZERO);
}

/********************************************************************
 * @brief Decrypt packet
 */
function ctr_Decrypt($SMS, $key)
{
	$input_raw = substr($SMS, 8, 260);
	$input     = pack("H*" , $input_raw);
	$key       = pack("H*" , $key);
	$cpa       = substr($SMS, 268, 8);
	$iv        = pack("H*" , $cpa. $cpa. $cpa. $cpa);
	
	$CTR_DECRYPT = strtoupper( bin2hex( ctr_crypt($input, 9, $key, $iv)));
	$CTR_DECRYPT = substr($SMS, 0, 8)
	            .$CTR_DECRYPT
	            .CPA_ZERO	// $cpa
	            .substr($SMS, 276, 4);
	
	return $CTR_DECRYPT;
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
 * @brief Show disp information in short view
 */
function ctrDisp($funct, $struct)
{
	$answer  = $funct;
	$answer .= " ($struct)";
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
function ctr_show_packet($SMS, &$disp)
{
	$CTR_CRC = CRC16(substr($SMS, 0, -4));
	$SMS_FRAME = ctr_analyze_frame($SMS, $CTR_CRC);

	// poriadok s disp
	$disp = ctrDisp($SMS_FRAME['FUNCT'][1], $SMS_FRAME['STRUCT']);

	$out  = "<table class='table-style-two'>\n";
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
* @brief Show analyze SMS
* @retval HTML table format
*/
function ctr_show($SMS)
{
	$SMS = explode("\n", $SMS);

	// single line
	if( count($SMS) <= 1)
		return ctr_show_packet($SMS[0], $disp);
	
	// multi line
	$first = true;
	foreach ($SMS as $SMS_LINE)
	{
		$hint = add_soft_space($SMS_LINE, SMS_SIZE);
		$out_line = ctr_show_packet($SMS_LINE, $disp);
		$out .= "<li><a href='index.php?CTR_FRAME=$SMS_LINE' title='$hint'>+ $disp</a>";
		$out .= $first? "<ul class='hidden'>": "<ul>";
		$out .= $out_line;
		$out .= "<br></ul></li>";
		$first = false;
	}
	
	return "\n<ul class='menu'>". $out ."</ul>";
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

	$answer[] = strtoupper(dechex($profi)) ."h";
	
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
	
	$answer[] = strtoupper(dechex($funct)) ."h";
	$answer[] = ctr_funct_name($funct & 0x3F);
	$answer[] = $encrypt_text[ $funct >> 6 ];
	return $answer;
}

/********************************************************************
* @brief Check CRC
*/
function ctr_CRCCheck($crc, $crc_compute)
{
	$crc_compute = substr($crc_compute, 2, 2). substr($crc_compute, 0, 2);
	
	if( $crc_compute == $crc )
		$answ = "$crc - OK";
	else
		$answ = "$crc - bad, correctly $crc_compute";
				
	return $answ;
}

/********************************************************************
* @brief MetaAnalyze frame name
*/
function ctr_analyze_frame(&$SMS, $CTR_CRC)
{
	if((strlen($SMS) != (2*SMS_SIZE)) 
	&& (strlen($SMS) != (2*SMS_SIZE_LONG)))
		$SMS_DATI['LEN'] = "packet len ". strlen($SMS)/2 ." is unsupported";

	$SMS_DATI['ADD']   = substr_cut($SMS, 2);
	$SMS_DATI['PROFI'] = substr_cut($SMS, 1);
	$SMS_DATI['FUNCT'] = substr_cut($SMS, 1);
	$SMS_DATI['STRUCT']= substr_cut($SMS, 1);
	$SMS_DATI['CHAN']  = substr_cut($SMS, 1) ."h";
	$SMS_DATI['DATI']  = ($SMS_DATI['FUNCT'] != CTR_ELGAS_HEX)? substr_cut($SMS, 128): substr_cut($SMS, strlen($SMS)/2 - 6); 
	if( strlen($SMS) > 12) {
		$SMS_DATI['VATA'] = add_soft_space(substr_cut($SMS, (strlen($SMS)-12)/2), 64);
	}
	$SMS_DATI['CPA']   = substr_cut($SMS, 4);
	$SMS_DATI['CRC']   = ctr_CRCCheck($SMS, $CTR_CRC);
	
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
				$answer = ctr_Query_50($DATI);
				break;

			case CTR_STR_ARRAY:
				require_once 'struct/51-array.php';
				$answer = ctr_Query_51($DATI);
				break;
				
			case CTR_STR_TRACE:
				require_once 'struct/52-trace.php';
				$answer = ctr_Query_52($DATI);
				break;
				
			case CTR_STR_TRACE_C:
				require_once 'struct/53-trace_c.php';
				$answer = ctr_Query_53($DATI);
				break;

			case CTR_STR_OPTIONAL:
				require_once 'struct/54-optional.php';
				$answer = ctr_Query_54($DATI);
				break;
				
			case CTR_STR_SCHEMA:
				require_once 'struct/55-trama.php';
				$answer = ctr_Query_55($DATI);
				break;
				
			case CTR_STR_EVENT:
				require_once 'struct/56-event.php';
				$answer = ctr_Query_56($DATI);
				break;
				
			case CTR_STR_TRIGGER_EVENT:
				require_once 'struct/f1-event_trigger.php';
				$answer = ctr_Query_f1($DATI);
				break;
				
			case CTR_STR_IDENTIF:
			case CTR_STR_IDENTIF2:
				require_once 'struct/30-identification.php';
				$answer = ctr_Query_30($DATI, $sms_struct);
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
					$answer = ctr_Answer_50($DATI);
					break;

				case CTR_STR_ARRAY:
					require_once 'struct/51-array.php';
					$answer = ctr_Answer_51($DATI);
					break;
							
				case CTR_STR_TRACE:
					require_once 'struct/52-trace.php';
					$answer = ctr_Answer_52($DATI);
					break;

				case CTR_STR_TRACE_C:
					require_once 'struct/53-trace_c.php';
					$answer = ctr_Answer_53($DATI);
					break;

				case CTR_STR_OPTIONAL:
					require_once 'struct/54-optional.php';
					$answer = ctr_Answer_54($DATI);
					break;

				case CTR_STR_SCHEMA:
					require_once 'struct/55-trama.php';
					$answer = ctr_Answer_55($DATI);
					break;

				case CTR_STR_EVENT:
					require_once 'struct/56-event.php';
					$answer = ctr_Answer_56($DATI);
					break;
						
				case CTR_STR_TRIGGER_EVENT:
					require_once 'struct/f1-event_trigger.php';
					$answer = ctr_Answer_f1($DATI);
					break;
						
				case CTR_STR_IDENTIF:
				case CTR_STR_IDENTIF2:
					require_once 'struct/30-identification.php';
					$answer = ctr_Answer_30($DATI, $sms_struct);
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
					$answer = ctr_Write_2f($DATI);
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
			$answer = ctr_Write_23($DATI);
			break;


		case CTR_DOWNLOAD:
			require_once 'struct/24-download.php';
			$answer = ctr_Write_24($DATI);
			break;
						
		case CTR_END:
			break;
					
		case CTR_IDENTIF:
			require_once 'struct/30-identification.php';
			$answer = ctr_Query_30($DATI, $sms_struct);
			break;

		case CTR_IDENTIF_ANSW:
			require_once 'struct/30-identification.php';
			$answer = ctr_Answer_30($DATI, $sms_struct);
			break;

		case CTR_ELGAS:
			$length = (hexdec(substr_cut($DATI, 1)) + 0x100 * hexdec(substr_cut($DATI, 1))) - 3;
			$type   = hexdec(substr_cut($DATI, 1));
			$group  = hexdec(substr_cut($DATI, 1));
			$port   = hexdec(substr_cut($DATI, 1));
			$answer = json_decode( file_get_contents('http://'. $_SERVER['HTTP_HOST']. '/elgas2/index.php?JSON&ELGAS_FRAME='. $DATI. '&GROUP='. $group. '&TYPE='. $type), true);
			$DATI   = "";
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
