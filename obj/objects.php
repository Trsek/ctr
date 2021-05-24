<?php
require_once("obj/objects.inc");
require_once("obj/objects_special.php");

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
* @brief Convert hex to string
*/
function hexToStr($hex)
{
	$string='';
	for ($i=0; $i < strlen($hex)-1; $i+=2){
		$string .= chr(hexdec($hex[$i].$hex[$i+1]));
	}
	return $string;
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
		array('Standart time',	                    // 0
              'Value during Daylight saving time'); // 1
		
	$kmolt = $qlf & 0x07;
	$val   = ($qlf >> 3) & 0x03;
	$sl    = ($qlf >> 5) & 0x01;
	$if12  = $qlf >> 6;
	
	$answer[] = sprintf( "%02Xh - Qualifier", $qlf);
	$answer[] = sprintf( " %02d - %s", decbin($if12), $band_text[$if12]);
	$answer[] = sprintf( " %01d - %s", decbin($sl),   $sl_text[$sl]);
	$answer[] = sprintf( " %02d - %s", decbin($val),  $val_text[$val]);
	$answer[] = sprintf( " %03d - 10^-Kmolt", $kmolt);
	return $answer;
}

/********************************************************************
* @brief Parse uchar qualify byte
*/
function ctr_qlf_short($qlf)
{
	$band_text = 
		array('',	           // 00
              'band 1',        // 01
              'band 2',        // 10
              'band 3');       // 11
	
	$val_text = 
		array('',	           // 00
              'naintenance',   // 01
              'not valid',     // 10
              '');             // 11
	
	$sl_text = 
		array('', 	           // 0
              'DST');          // 1
		
	$kmolt = $qlf & 0x07;
	$val   = ($qlf >> 3) & 0x03;
	$sl    = ($qlf >> 5) & 0x01;
	$if12  = $qlf >> 6;
	
	$add_text = (empty($band_text[$if12])? "": $band_text[$if12].", ")
	           .(empty($sl_text[$sl])? "": $sl_text[$sl].", ")
	           .(empty($val_text[$val])? "": $val_text[$val].", ")
	           .(($kmolt==0)? "": "10^-$kmolt, ")
	           ;
	if( strlen($add_text))
		$add_text = "(". substr($add_text, 0, strlen($add_text)-2) .")";
	
	if( $qlf == 0xFF )
		$add_text = "(without value)";
	
	$answer = sprintf(" %02Xh - .qlf %s", $qlf, $add_text);
	return $answer;
}

/********************************************************************
* @brief Check if string inform about " 10 - Value not valid"
*/
function ctr_qlf_valid($DATI)
{

	$qlf = hexdec(substr($DATI, 0, 3));
	return !(($qlf >> 3) & 0x02);
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
		 UNIT_DEFAULT =>"",			
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
		 UNIT_h =>      "hrs",
		 UNIT_dB =>     "dB",
		 UNIT_HEX =>    "h",
		 UNIT_percent =>"%",
	);
		
	return $unit_str[$unit];
}

/********************************************************************
* @brief CTR date presentation
*/
function ctr_date($DATI, $count)
{
	// have day of week
	if( $count > 5 )
	{
		$week = hexdec(substr($DATI,6,2));
		$DATI = substr($DATI,0,6) .substr($DATI,8,strlen($DATI));
		$count--;
	}
	
	$data_year   = ($count>0)? hexdec(substr_cut($DATI, 1))+2000: 2000;	
	$data_month  = ($count>1)? hexdec(substr_cut($DATI, 1)): 1;	
	$data_day    = ($count>2)? hexdec(substr_cut($DATI, 1)): 1;	
	$data_hour   = ($count>3)? hexdec(substr_cut($DATI, 1)): 0;	
	$data_minute = ($count>4)? hexdec(substr_cut($DATI, 1)): 0;	
	$data_second = ($count>5)? hexdec(substr_cut($DATI, 1)): 0;
	$data_gmt    = ($count>6)? hexdec(substr_cut($DATI, 1)): 0;
	$data_dst    = ($count>7)? hexdec(substr_cut($DATI, 1)): 0;
	
	// daylight time
	$dst = "";
	if( $data_hour > 30 )
	{
		$data_hour -= 30;
		$dst = " dst";
	}
	if( $data_gmt ) $dst .= " gmt=".$data_gmt;
	if( $data_dst ) $dst .= " dst=active";
	
	switch($count)
	{
		case 1:	return sprintf("%04d", $data_year);	break;
		case 2:	return sprintf("%04d-%02d", $data_year, $data_month);	break;
		case 3:	return sprintf("%04d-%02d-%02d", $data_year, $data_month, $data_day);	break;
		case 4:	return sprintf("%04d-%02d-%02d %02d %s", $data_year, $data_month, $data_day, $data_hour, $dst);	break;
		case 5:	return sprintf("%04d-%02d-%02d %02d:%02d %s", $data_year, $data_month, $data_day, $data_hour, $data_minute, $dst);	break;
		case 6:	
		case 7:	
		case 8:	
		default:
			    return sprintf("%04d-%02d-%02d %02d:%02d:%02d %s", $data_year, $data_month, $data_day, $data_hour, $data_minute, $data_second, $dst);	break;
	}
	return "";
}

/********************************************************************
 * @brief CTR date presentation with operator, profile inside
 */
function ctr_date_event($value, $count)
{
	$month = hexdec(substr($value,2,2));
	$day = hexdec(substr($value,4,2));

	$value = substr_replace($value, str_pad(dechex($month & 0x0F), 2, "0", STR_PAD_LEFT), 2, 2);
	$value = substr_replace($value, str_pad(dechex($day & 0x1F), 2, "0", STR_PAD_LEFT), 4, 2);

	$answer = array();
	$answer[] = ctr_date($value, $count);
	$answer[] = ($month >> 4) . " - operator";
	$answer[] = ($day >> 5) ." - profile";

	return $answer;
}

/********************************************************************
* @brief When need value to one line
*/
function array_val_line($value)
{
	if(!is_array($value))
		return $value[0];

	$answer = "";
	foreach ($value[0] as $value_line)
	{
		$answer .= (empty($answer)? "": ", "). $value_line;
	}
	return $answer;
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
	$companion = false;
	
	if( $attw & 0x01 ) $qlf = hexdec( substr_cut($DATI, 1));
	if( $attw & 0x02 ) 
	{
		do {
		if( $qlf == 0xFF ) {
			$val[] = " NaN";
			break;
		}
		$len = $CTR_List[$obj_id][CTR_LEN];
		$value = substr_cut($DATI, $len);		
		switch( $CTR_List[$obj_id][CTR_TYPE])
		{
			case VAL_TYPE_BIT:
					$value = hex2bin($value);
					break;
			case VAL_TYPE_DOUBLE_QLF:
					$qlf = substr_cut($value, 1);
					/* no break; */
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
					$value = hexToStr($value);
					break;
			case VAL_TYPE_TIME_MSP:
			case VAL_TYPE_DATE_MSP:
			case VAL_TYPE_DATETIME:
			case VAL_TYPE_DATETIMEBCD:
					if ( $obj_id == "10.0.1")
						$value = ctr_date_event($value, $len);
					else
						$value = ctr_date($value, $len);
					break;
			case VAL_TYPE_DEFAULT:
			case VAL_TYPE_OKNO:
					if( $obj_id ==  "E.C.0" ) $value = ctr_db($value);
					if( $obj_id == "F0.0.3" ) $value = ctr_event($value);
					if( $obj_id == "F1.A.2" ) $value = ctr_qcb_time($value, $qlf);
					if( $obj_id == "F1.A.5" ) $value = ctr_qcb_dtime($value, $qlf);
					if( $obj_id ==  "8.0.2" ) $value = ctr_closure_billing($value);
					if( $obj_id ==  "8.2.0" ) $value = ctr_dst($value);
					if( $obj_id ==  "9.5.0" ) $value = ctr_padl($value);
					if( $obj_id ==  "A.B.1" ) $value = ctr_met_sp_Z($value);
					if( $obj_id ==  "A.B.2" ) $value = ctr_met_Z($value);
					if( $obj_id ==  "A.B.3" ) $value = ctr_met_sp_V($value);
					if( $obj_id ==  "A.B.4" ) $value = ctr_met_V($value);						
					if( $obj_id ==  "C.0.2" ) $value = ctr_type_imp($value);
					if( $obj_id ==  "C.0.3" ) $value = ctr_metering_type($value);
					if( $obj_id ==  "D.9.0" ) $value = ctr_seal($value);
					if( $obj_id ==  "E.0.1" ) $value = ctr_inbound($value);
					if( $obj_id ==  "E.1.5" ) $value = ctr_cmode($value);
					if( $obj_id ==  "E.2.1" ) $value = ctr_dce($value);
					if( $obj_id ==  "E.6.0" ) $value = ctr_tlv($value);
					if( $obj_id ==  "E.7.0" ) $value = ctr_wake_up($value);
					if( $obj_id ==  "E.E.1" ) $value = ctr_gprs_set($value);
					if( $obj_id ==  "11.0.5" ) $value = ctr_set_password($value);
					if( $obj_id ==  "11.0.A" ) $value = ctr_replace_battery($value);
					if( $obj_id ==  "11.0.B" ) $value = ctr_F_PT($value);
					if( $obj_id ==  "11.0.C" ) $value = ctr_F_AKT($value);
					if( $obj_id ==  "11.1.7" ) $value = ctr_F_Call($value);
					if( $obj_id ==  "12.0.0" ) $value = ctr_sd($value);
					if( $obj_id ==  "12.3.1" ) $value = ctr_sens_stat($value);
					if( $obj_id ==  "F3.4.3" ) $value = ctr_obj_name(ctr_obj_number($value));					
					if( $obj_id ==  "13.6.1" ) $value = ctr_Conf_P($value);
					if( $obj_id ==  "13.6.2" ) $value = ctr_Conf_T($value);
					if( $obj_id ==  "15.2.1" ) $value = ctr_array_list($value);
					if( $obj_id ==  "17.0.2" ) $value = ctr_PerFat($value);
					if( $obj_id ==  "17.0.3" ) $value = ctr_data_SW($value);
					if( $obj_id ==  "17.0.4" ) $value = ctr_ID_PT($value);
					if( substr($obj_id, 0,4) ==  "E.D." ) $value = ctr_voluntary($value);
					if(( substr($obj_id, 0,4) == "E.3." )
					|| ( substr($obj_id, 0,4) == "E.4." )
					|| ( substr($obj_id, 0,4) == "E.5." ))
						$value = ctr_call_map($value);
					if(( substr($obj_id, 0,5) == "12.1." )
					|| ( substr($obj_id, 0,5) == "12.2." )
					|| ( substr($obj_id, 0,5) == "12.6." ))
						$value = ctr_status($value);
					if(( substr($obj_id, 0,5) == "15.0." )
					|| ( substr($obj_id, 0,5) == "15.1." ))
						$value = ctr_traces_list($value);
					if(( $obj_id ==  "11.0.6" )
					|| ( $obj_id ==  "11.0.7" ))
						 $value = ctr_seals($value);		
					if(( $obj_id ==  "17.0.0" )
					|| ( $obj_id ==  "17.0.1" ))
						 $value = ctr_PT($value);
					break;
		}
		
		// kmolt usage
		if(( $attw & 0x01 )
		&&  !is_array($value))
		{
			$kmolt = $qlf & 0x07;
			while( $kmolt-- )
				$value /= 10;
		}
		
		// divide value if need
		if( is_array($value)) {
			foreach ($value as $value_line)
				$val[] = " ". $value_line ." ". ctr_get_mj($CTR_List[$obj_id][CTR_UNIT]);
		}
		else {
			$val[] = " ". $value ." ". ctr_get_mj($CTR_List[$obj_id][CTR_UNIT]) .($companion? (" - ".$CTR_List[$obj_id][CTR_DESCRIPTION]): "");
		}
		
		// next id
		$obj_id = $CTR_List[$obj_id][CTR_COMPANION_OBJ_ID];
		$companion = true;
		} while( $obj_id != "0.0.0");
	}
	
	if( $attw & 0x04 ) $access  = hexdec(substr_cut($DATI, 1));
	if( $attw & 0x08 ) $default = substr_cut($DATI, $len);

	$answer = [];
	if( $attw & 0x02 ) $answer[] = $val;
	if( $attw & 0x01 ) $answer[] = ctr_qlf_short($qlf);
	if( $attw & 0x04 ) $answer[] = ctr_access($access);
	if( $attw & 0x08 ) $answer[] = "default: ". $default;
	
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
