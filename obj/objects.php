<?php
require_once("obj/objects.inc");

/********************************************************************
* @brief Strip 'len' chars from start of string 
*/
function substr_cut(&$SMS, $len)
{
	$cut_str = substr($SMS, 0, 2*$len);
	$SMS = substr($SMS, 2*$len, strlen($SMS) - 2*$len);
	return $cut_str;
}

/********************************************************************
* @brief hex2bin in PHP < 5.4.0
*/
if (PHP_VERSION_ID < 50400) {
function hex2bin($hex_string)
{
	return pack("H*" , $hex_string);
}
}

/********************************************************************
* @brief Parse ushort to text ppresentation
*/
function ctr_obj_number($OBJ)
{
	global $CTR_List;
	
	$c = hexdec( substr($OBJ, 0, 2));
	$s = hexdec( substr($OBJ, 2, 2)) >> 4; 
	$d = hexdec( substr($OBJ, 2, 2)) & 0x0F; 
	
	$answer = sprintf( "%X.%X.%X", $c, $s, $d);

	// add new for this time
	if( $CTR_List[$answer] == null )
		$CTR_List[$answer] = $CTR_List["0.0.0"]; 

	return $answer; 
}

/********************************************************************
* @brief Parse uchar qualify byte
*/
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

/********************************************************************
* @brief Check if string inform about " 10 - Valid"
*/
function ctr_qlf_valid($DATI)
{
	$qlf = hexdec(substr($DATI, 0, 2));
	return ($qlf >> 3) & 0x03;
}

/********************************************************************
* @brief Parse uchar access
*/
function ctr_access($access)
{
	$access_write = $access >> 4;
	$access_read  = $access & 0x0F;
	
	$answer[] = "Access";  
	$answer[] = sprintf( "%04d - Write for group ABCD", decbin( $access_write ));  
	$answer[] = sprintf( "%04d - Read for group ABCD", decbin( $access_read ));
	return $answer;
}

/********************************************************************
* @brief Parse uchar attw
*/
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

/********************************************************************
* @brief Human presentation of Object id
*/
function ctr_obj_name($obj_id)
{
	global $CTR_List;

	$CTR_List_leap = $CTR_List[$obj_id];
	return (string)$obj_id. " - ". $CTR_List_leap[CTR_DESCRIPTION];
}

/********************************************************************
* @brief Return text presentation unit of measure
*/
function ctr_get_mj($unit)
{
	$unit_str = array(
		 UNIT_stC =>    "°C",
		 UNIT_stF =>    "°F",
		 UNIT_Kelvin => "K",
		 UNIT_stR =>    "°R",
		 UNIT_kPa =>    "kPa",
		 UNIT_Pa =>     "Pa",
		 UNIT_MPa =>    "MPa",
		 UNIT_bar =>    "bar",
		 UNIT_torr =>   "torr",
		 UNIT_PSI =>    "PSI",
		 UNIT_at =>     "at",
		 UNIT_kgfcm2 => "kgf/cm²",
		 UNIT_atm =>    "atm",
		 UNIT_MJm3 =>   "MJ/m³",
		 UNIT_kWhm3 =>  "kWh/m³",
		 UNIT_Btuft3 => "Btu/ft³",
		 UNIT_MJ =>     "MJ",
		 UNIT_kWh =>    "kWh",
		 UNIT_Btu =>    "Btu",
		 UNIT_m3 =>     "m³",
		 UNIT_ft3 =>    "ft³",
		 UNIT_nm3 =>    "nm³",
		 UNIT_nft3 =>   "nft³",
		 UNIT_m3h =>    "m³/h",
		 UNIT_ft3h =>   "ft³/h",
		 UNIT_nm3h =>   "nm³/h",
		 UNIT_nft3h =>  "nft³/h",
		 UNIT_yard3h => "yard³/h",
		 UNIT_galh =>   "gal³/h",
		 UNIT_yard3 =>  "yard³",
		 UNIT_gal =>    "galon",
		 UNIT_V =>      "V",
		 UNIT_mV =>     "mV",
		 UNIT_A =>      "A",
		 UNIT_mA =>     "mA",
		 UNIT_m =>      "m",
		 UNIT_ft =>     "ft",
		 UNIT_kgm3 =>   "kg/m³",
	);
		
	return $unit_str[$unit];
}

/********************************************************************
* @brief CTR date presentation
*/
function ctr_date($DATI, $count)
{
	$data_year   = ($count>0)? hexdec(substr_cut($DATI, 1))+2000: 2000;	
	$data_month  = ($count>1)? hexdec(substr_cut($DATI, 1)): 1;	
	$data_day    = ($count>2)? hexdec(substr_cut($DATI, 1)): 1;	
	$data_hour   = ($count>3)? hexdec(substr_cut($DATI, 1)): 0;	
	$data_minute = ($count>4)? hexdec(substr_cut($DATI, 1)): 0;	
	$data_second = ($count>5)? hexdec(substr_cut($DATI, 1)): 0;
	
	// daylight time
	$dst = "";
	if( $data_hour > 30 )
	{
		$data_hour -= 30;
		$dst = " dst";
	}

	switch($count)
	{
		case 1:	return sprintf("%04d", $data_year);	break;
		case 2:	return sprintf("%04d-%02d", $data_year, $data_month);	break;
		case 3:	return sprintf("%04d-%02d-%02d", $data_year, $data_month, $data_day);	break;
		case 4:	return sprintf("%04d-%02d-%02d %02d %s", $data_year, $data_month, $data_day, $data_hour, $dst);	break;
		case 5:	return sprintf("%04d-%02d-%02d %02d:%02d %s", $data_year, $data_month, $data_day, $data_hour, $data_minute, $dst);	break;
		case 6:	return sprintf("%04d-%02d-%02d %02d:%02d:%02d %s", $data_year, $data_month, $data_day, $data_hour, $data_minute, $data_second, $dst);	break;
	}
	return "";
}

/********************************************************************
* @brief Parse value
*/
function ctr_val(&$DATI, $obj_id, $attw)
{
	global $CTR_List;

	$CTR_List_leap = $CTR_List[$obj_id];
	$qlf = 0;
	$value = "";
	
	if( $attw & 0x01 ) $qlf = hexdec( substr_cut($DATI, 1));
	if( $attw & 0x02 ) 
	{
		do {
		$len = $CTR_List[$obj_id][CTR_LEN];
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
					break;
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
		
		$val[] = $value ." ". ctr_get_mj($CTR_List[$obj_id][CTR_UNIT]);
		$obj_id = $CTR_List[$obj_id][CTR_COMPANION_OBJ_ID];
		} while( $obj_id != "0.0.0");
	}
	
	if( $attw & 0x04 ) $access  = hexdec(substr_cut($DATI, 1));
	if( $attw & 0x08 ) $default = substr_cut($DATI, $len);

	$answer = "";
	if( $attw & 0x02 ) $answer[] = $val;
	if( $attw & 0x01 ) $answer[] = ctr_qlf($qlf);
	if( $attw & 0x04 ) $answer[] = ctr_access($access);
	if( $attw & 0x08 ) $answer[] = $default;
	
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
