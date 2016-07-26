<?php
require_once("objects.inc");

// odsekne 'len' hex znakov zo zaciatku retazca
function substr_cut(&$SMS, $len)
{
	$cut_str = substr($SMS, 0, 2*$len);
	$SMS = substr($SMS, 2*$len, strlen($SMS) - 2*$len);
	return $cut_str;
}

function hex2float($strHex) 
{
	$hex = sscanf($strHex, "%02x%02x%02x%02x%02x%02x%02x%02x");
	$hex = array_reverse($hex);
	$bin = implode('', array_map('chr', $hex));
	$array = unpack("dnum", $bin);
	return $array['num'];
}

// parse ushort to text ppresentation
function ctr_obj_number($OBJ)
{
	$c = hexdec( substr($OBJ, 0, 2));
	$s = hexdec( substr($OBJ, 2, 2)) >> 4; 
	$d = hexdec( substr($OBJ, 2, 2)) & 0x0F; 
	
	$answer = sprintf( "%X.%X.%X", $c, $s, $d);
	return $answer; 
}

// parse uchar qualify
function ctr_qlf($qlf)
{
	$band_text = 
		array('Tariff scheme not active',	         // 00
              'Data recorded against price band 1',  // 01
              'Data recorded against price band 2',  // 10
              'Data recorded against price band 3'); // 11
	
	$val_text = 
		array('Valid effective value',	            // 00
              'Value when subject to maintenance',  // 01
              'Value not valid',                    // 10
              'Reserved');                          // 11
	
	$sl_text = 
		array('Value during Daylight saving time',	// 0
              'Standart time');                     // 1
		
	$kmolt = $qlf & 0x07;
	$val   = ($qlf >> 3) & 0x03;
	$sl    = ($qlf >> 5) & 0x01;
	$if12  = $qlf >> 6;
	
	$answer[] = sprintf( "%02Xh - Qualifier", $qlf);
	$answer[] = sprintf( " %02d - %s", decbin($if12), $band_text[$if12]);
	$answer[] = sprintf( " %01d - %s", decbin($sl),   $sl_text[$val]);
	$answer[] = sprintf( " %02d - %s", decbin($val),  $val_text[$val]);
	$answer[] = sprintf( " %03d - 10^-Kmolt", $kmolt);
	return $answer;
}

// parse uchar access
function ctr_access($access)
{
	$access_write = $access >> 4;
	$access_read  = $access & 0x0F;
	
	$answer[] = "Access";  
	$answer[] = sprintf( "%04d ABCD", decbin( $access_write ));  
	$answer[] = sprintf( "%04d ABCD", decbin( $access_read ));
	return $answer;
}

// parse uchar attw
function ctr_attw($attw)
{
	$answer[] = sprintf( "%02Xh - Attribute type", $attw);
	if( $attw & 0x01 ) $answer[] = " .qlf - Qualifier";
	if( $attw & 0x02 ) $answer[] = " .val - Value fields";
	if( $attw & 0x04 ) $answer[] = " .access - Access descriptor";
	if( $attw & 0x08 ) $answer[] = " .def - Default value";
	if( $attw & 0xF0 ) $answer[] = " Unknown";
	return $answer;
}

// parse value
function ctr_obj_name($obj_id)
{
	global $CTR_List;

	$CTR_List_leap = $CTR_List[$obj_id];
	return (string)$obj_id. " - ". $CTR_List_leap[CTR_DESCRIPTION];
}

// parse value
function ctr_val(&$DATI, $obj_id, $attw)
{
	global $CTR_List;

	$CTR_List_leap = $CTR_List[$obj_id]; 
	$len = $CTR_List[$obj_id][CTR_LEN];
	$qlf = 0;
	$value = "";
	
	if( $attw & 0x01 ) $qlf = hexdec( substr_cut($DATI, 1));
	if( $attw & 0x02 ) 
	{
		do {
		$value = substr_cut($DATI, $len);		
		switch( $CTR_List[$obj_id][CTR_TYPE])
		{
			case VAL_TYPE_BIT:
					$value = hexbin($value);
					break;
			case VAL_TYPE_FLOAT:
			case VAL_TYPE_DOUBLE:
			case VAL_TYPE_BYTE:
			case VAL_TYPE_UINT:
			case VAL_TYPE_ULONG:
			case VAL_TYPE_ULONG64:
					$value = hexdec($value);
					break;
			case VAL_TYPE_STRING3:
			case VAL_TYPE_STRING8:
			case VAL_TYPE_STRING16:
			case VAL_TYPE_STRING32:
				    $string='';
				    for ($i=0; $i < strlen($value)-1; $i+=2){
				        $string .= chr(hexdec($value[$i].$value[$i+1]));
				    }
				    $value = $string;
					break;
			case VAL_TYPE_TIME_MSP:
			case VAL_TYPE_DATE_MSP:
			case VAL_TYPE_DATETIME:
			case VAL_TYPE_DATETIMEBCD:
			
			case VAL_TYPE_DEFAULT:
			case VAL_TYPE_OKNO:
				break;
		}
		
		// kmolt usage
		if( $attw & 0x01 )
		{
			$kmolt = $qlf & 0x07;
			while( $kmolt-- )
				$value /= 10;
		}
		
		$val[] = $value;
		$obj_id = $CTR_List[$obj_id][CTR_COMPANION_OBJ_ID];
		} while( $obj_id != "0.0.0");
	}
	
	if( $attw & 0x04 ) $access  = substr_cut($DATI, 1);
	if( $attw & 0x08 ) $default = substr_cut($DATI, $len);

	$answer = "";
	if( $attw & 0x02 ) $answer[] = $val;
	if( $attw & 0x01 ) $answer[] = ctr_qlf($qlf);
	if( $attw & 0x04 ) $answer[] = ctr_access($access);
	if( $attw & 0x08 ) $answer[] = $default;
	
	return $answer;
}
