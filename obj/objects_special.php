<?php

function ctr_db($value)
{
	$value = hexdec($value);
	if( $value & 0x80 )
		$value = (-1)*(128 - ($value & 0x7F));
	return $value;
}

function ctr_call_map($value)
{
	$tipo_text = array(
		0x00 => "None",
		0x01 => "PSTN",
		0x02 => "GSM only SMS",
		0x03 => "reserved",
		0x04 => "GPRS",
		0x05 => "GSM data only",
		0x06 => "reserved",
		0x07 => "reserved",
		0x08 => "ADSL",
		0x09 => "ISDN",
		0x0A => "Ethernet",
		0x0B => "Router Wireless",
		0x0C => "Router PLC",
		0x0D => "Dedicated line",
	);

	$tipo = hexdec(substr_cut($value, 1));
	$answer[] = dechex($tipo). " - ". $tipo_text[$tipo];
	
	switch( $tipo )
	{
		case 0x01:
		case 0x02:
		case 0x05:
		case 0x06:
			$answer[] = hexToStr($value) ." - telephone number";
			break;
		case 0x04:
			$answer[] = substr_cut($value,1) ." - IPPT";
			$answer[] = ctr_ip_address($value) .":". hexdec(substr_cut($value,2));
			break;
		default:
			$value = trim(hexToStr($value));
			if( !empty($value))
				$answer[] = $value;
			break;
			
	}
	return $answer;
}

function ctr_event($value)
{
	$event_text = array(
		0x30 => "Generic",
		0x31 => "Over limit",
		0x32 => "Out of range",
		0x33 => "Programming",
		0x34 => "Modification of a relevant parameter",
		0x35 => "General fault",
		0x36 => "Primary supply OFF",
		0x37 => "Battery low",
		0x38 => "Modify date&time",
		0x3A => "Calculation error",
		0x3B => "Reset database",
		0x3C => "Relevant seal deactivated (note 1)",
		0x3D => "Synchronization error",
		0x3E => "Reset event queue",
		0x3F => "Day light saving time programming",
		0x40 => "Event buffer full",
		0x41 => "Tariff scheme Configuration",
		0x42 => "Activation of a new tariff scheme",
		0x43 => "Download of new software",
		0x44 => "Activation of new software",
		0x45 => "Reserved",
		0x46 => "Fraud attempt",
		0x47 => "Change of status",
		0x48 => "Programming failed",
		0x49 => "Flow cut-off",
		0x4A => "Pressure cut-off",
		0x4B => "Halt volume calculation at standard therm. cond.",
		0x4C => "Modification of security parameter",
		0x4D => "Replace batteries",
	);
	
	$Code = hexdec(substr_cut($value, 1));
	$answer = strtoupper(dechex($Code)). " - ". $event_text[$Code] ." (";
	
	switch( $Code )
	{
		case 0x30:
		case 0x31:
		case 0x32:
		case 0x33:
		case 0x35:
		case 0x36:
		case 0x37:
		case 0x3A:
		case 0x3B:
		case 0x3C:
		case 0x44:
		case 0x46:
		case 0x47:
		case 0x48:
		case 0x49:
		case 0x4A:
		case 0x4B:
		case 0x4C:
		case 0x4D:
			$kmolt = hexdec(substr_cut($value, 1)) & 0x07;
			$val = hexdec(substr_cut($value, 4));
			while( $kmolt-- ) $val /= 10;
			$answer .= "Tot_Vb = ". $val;
			break;
		case 0x34:
			substr_cut($value, 1);
			$answer .= ctr_obj_number( substr_cut($value, 2));
			substr_cut($value, 1);
			$answer .= " = ". substr_cut($value, 1);
			break;
		case 0x35:
		case 0x3D:
		case 0x38:
			substr_cut($value, 1);
			$answer .= ctr_date( substr_cut($value, 3),3);
			$answer .= " day = ". substr_cut($value, 1);
			break;
		case 0x3E:
		case 0x40:
			substr_cut($value, 3);
			$answer .= "MEM = ". hexdec( substr_cut($value, 2));
			break;
		case 0x3F:
			substr_cut($value, 3);
			$answer .= "OL = ". hexdec( substr_cut($value, 2));
			break;
		case 0x41:
		case 0x42:
			substr_cut($value, 2);
			$answer .= "APT = ". substr_cut($value, 1) .",";
			$answer .= "ID_PT = ". substr_cut($value, 1);
			break;
		case 0x43:
			substr_cut($value, 2);
			$answer .= " = ". hex2bin(substr_cut($value, 5));
			break;
	}
	
	$zbytok = substr_cut($value, 0, 4-strlen($value)/2);
	$answer .= $zbytok. (strlen($zbytok)? "h":"") .",";
	switch( $Code )
	{
		case 0x30:
			substr_cut($value, 3);
			$answer .= hexdec(substr_cut($value, 1));
			break;
		case 0x31:
		case 0x32:
			substr_cut($value, 2);
			$answer .= ctr_obj_number( substr_cut($value, 2));
			break;
		case 0x35:
		case 0x46:
		case 0x48:
			substr_cut($value, 3);
			$answer .= hexdec( substr_cut($value, 1));
			break;
		case 0x37:
			substr_cut($value, 1);
			$answer .= hexdec( substr_cut($value, 3));
			break;
		case 0x38:
		case 0x3D:
			$answer .= hexdec( substr_cut($value, 1)) .":";
			$answer .= hexdec( substr_cut($value, 1)) .":";
			$answer .= hexdec( substr_cut($value, 1));
			break;
		case 0x3E:
			$answer .= hexdec( substr_cut($value, 4));
			break;
		case 0x43:
			substr_cut($value, 1);
			$answer .= ctr_date( substr_cut($value, 3),3);
			break;
		case 0x44:
			substr_cut($value, 1);
			$answer .= hex2bin( substr_cut($value, 4));
			break;
		case 0x47:
			substr_cut($value, 2);
			$answer .= hexdec( substr_cut($value, 2));
			break;
		case 0x49:
		case 0x4A:
			$kmolt = hexdec(substr_cut($value, 1)) & 0x07;
			$val = hexdec(substr_cut($value, 3));
			while( $kmolt-- ) $val /= 10;
			$answer .= $val;
			break;
		default:
			$answer .= $value ."h";
	}

	$answer .= ")";
	return $answer;
}

function ctr_qcb_time($value, &$qlf)
{
	$hour   = hexdec(substr_cut($value, 1));
	$minute = hexdec(substr_cut($value, 1));
	$dst    = ($qlf & 0x20)? " dst": "";
	$qlf    = 0;
	
	if( $hour > 30 )
	{
		$hour -= 30;
		$dst = " dst";
	}

	$answer = sprintf( "%02d:%02d%s", $hour, $minute, $dst);
	return $answer;
}

function ctr_qcb_dtime($value, &$qlf)
{
	$day    = hexdec(substr_cut($value, 1));
	$hour   = hexdec(substr_cut($value, 1));
	$minute = hexdec(substr_cut($value, 1));
	$dst    = ($qlf & 0x20)? " dst": "";
	$qlf    = 0;

	if( $hour > 30 )
	{
		$hour -= 30;
		$dst = " dst";
	}

	$answer = sprintf( "Day=%02d, %02d:%02d%s", $day, $hour, $minute, $dst);
	return $answer;
}

function ctr_closure_billing($value)
{
	$closure_text = array(
		0 => "Does not exist",
		1 => "For switching of vendor",
		2 => "For change of contract",
		3 => "For change of end consumer (transfer)",
		4 => "For switching of distributor",
		5 => "For the end of the billing period",
		6 => "For the start of a new tariff scheme",
	);
	
	$id = hexdec($value);
	return dechex($id). " - ". $closure_text[$id]; 
}

function ctr_dst($value)
{
	$abil         = substr_cut($value, 1); 	
	$mese_start   = substr_cut($value, 1); 	
	$giorno_start = substr_cut($value, 1); 	
	$mese_end     = substr_cut($value, 1); 	
	$giorno_end   = substr_cut($value, 1);

	$answer[] = hexdec($abil) ." - enable";
	$answer[] = hexdec($mese_start)   ." - start month";
	$answer[] = hexdec($giorno_start) ." - start day";
	$answer[] = hexdec($mese_end)     ." - end month";
	$answer[] = hexdec($giorno_end)   ." - end day";
	
	return $answer;
}

function ctr_padl($value)
{
	$padl_status_text = array(
		0 => "no DL active",
		1 => "DL in progress",
		2 => "DL finished; checking",
		3 => "DL finished; check OK",
		4 => "DL finished; check OK",
	);
	
	$status = hexdec(substr_cut($value, 1)); 	
	return dechex($status). " - ". $padl_status_text[$status]; 
}

function ctr_met_sp_Z($value)
{
	$met_sp_Z_text = array(
		0 => "UNI EN ISO 12213-3 (set a)",
		1 => "UNI EN ISO 12213-3 (set b)",
		2 => "UNI EN ISO 12213-3 (set c)",
		3 => "UNI EN ISO 12213-3 (set d)",
		4 => "AGA NX19 mod",
		5 => "AGA 8 gross method 1",
		6 => "AGA 8 gross method 2",
		7 => "AGA 8 detailed",
	);
	
	$answer[] = $value ."h";
	$value = hexdec($value);
	
	for($i=0; $i<count($met_sp_Z_text); $i++)
	{
		$bit = 1 << $i;
		if( $value & $bit ) 
			$answer[] = sprintf("%08d", decbin($bit)). " - ". $met_sp_Z_text[$i];
	}
	return $answer;
}

function ctr_met_Z($value)
{
	$met_Z_text = array(
		0 => "0 None (Z and Zb are fixed or not calculated)",
		1 => "UNI EN ISO 12213-3 (set a)",
		2 => "UNI EN ISO 12213-3 (set b)",
		3 => "UNI EN ISO 12213-3 (set c)",
		4 => "UNI EN ISO 12213-3 (set d)",
		5 => "AGA NX19 mod",
		6 => "AGA 8 gross method 1",
		7 => "AGA 8 gross method 2",
		8 => "AGA 8 detailed",
	);

	$answer[] = "$value - ". $met_Z_text[hexdec($value)];
	return $answer;
}

function ctr_met_sp_V($value)
{
	$met_sp_V_text = array(
		0 => "0 ISO 9951",
		1 => "AGA 3",
		2 => "AGA 7",
		3 => "AGA 9",
		4 => "UNI EN ISO 5167",
		5 => "UNI EN12405-1",
	);

	$answer[] = $value ."h";
	$value = hexdec($value);

	for($i=0; $i<count($met_sp_V_text); $i++)
	{
		$bit = 1 << $i;
		if( $value & $bit )
			$answer[] = sprintf("%08d", decbin($bit)). " - ". $met_sp_V_text[$i];
	}
	return $answer;
}

function ctr_met_V($value)
{
	$met_V_text = array(
		0 => "0 none",
		1 => "ISO 9951",
		2 => "AGA 3",
		3 => "AGA 7",
		4 => "AGA 9",
		5 => "UNI EN ISO 5167",
		6 => "UNI EN 12405-1",
	);

	$answer[] = "$value - ". $met_V_text[hexdec($value)];
	return $answer;
}

function ctr_seals($value)
{
	$seal_text = array(
			0x00 => "Reserved",
			0x01 => "Event log reset seal",
			0x02 => "Seal for restoring factory conditions",
			0x03 => "Seal for restoring the default values",
			0x04 => "Status change seal",
			0x05 => "Reserved",
			0x06 => "Reserved",
			0x07 => "Reserved",
			0x08 => "Reserved",
			0x09 => "Remote configuration seal. Parameters. Conversion",
			0x0A => "Remote configuration seal. Parameters. Analysis",
			0x0B => "Seal for downloading the program",
			0x0C => "Seal for restoring the default passwords",
	);

	$answer[] = $value ."h";
	$seal = hexdec(substr_cut($value, 1));

	for($i=0; $i<count($seal_text); $i++)
	{
		$bit = 1 << $i;
		if( $seal & $bit )
			$answer[] = sprintf("%08d", decbin($bit&0xFF)). " - ". $seal_text[$i];
	}
	$answer[] = hexdec(substr_cut($value, 1)) ." hour during";

	return $answer;
}

function ctr_set_password($value)
{
	$profile = substr_cut($value, 1);
	$answer[] = "$profile - Profile";
	$answer[] = hexToStr($value);
	return $answer;
}

function ctr_type_imp($value)
{
	$type_imp_text = array(
		0x00 => "General system (transmission)",
		0x01 => "General delivery system (transmission)",
		0x02 => "General redelivery system (transmission)",
		0x03 => "Civil redelivery system (transmission)",
		0x04 => "Industrial redelivery system (transmission)",
		0x05 => "Available for the transmission network",
		0x20 => "General system (distribution)",
		0x21 => "Civil system (distribution)",
		0x22 => "Commercial system (distribution)",
		0x23 => "Industrial system (distribution)",
		0x24 => "Other system (distribution)",
		0x25 => "3Fh Available for the distribution network",
	);
	
	$status = hexdec(substr_cut($value, 1));
	if( $status >= 0x05 && $status <= 0x1F ) $status = 0x05;
	if( $status >= 0x25 && $status <= 0x3F ) $status = 0x25;
	
	return dechex($status). "h - ". $type_imp_text[$status]; 
}

function ctr_replace_battery($value)
{
	for($i=1; $i<=4; $i++)
	{
		$m_batt = hexdec(substr_cut($value, 1));
		$type = $m_batt & 0xF0;
		$number = $m_batt & 0x0F;
		
		$answer[] = "Battery $i";
		if( $m_batt == 0 ) {
			$answer[] = " No battery is provided in the device";
			continue;
		}
		if( $m_batt == 0xFF ) {
			$answer[] = " To indicate that the battery in the device has not been changed";
			continue;
		}
		
		$answer[] = " $type - Type of battery";
		$answer[] = " $number - Number of batteries changed in each device";
	}
	
	return $answer;
}

function ctr_metering_type($value)
{
	$metering_type_text = array(
		0 => "Not defined",
		1 => "Data logger + converter via pulses",
		2 => "Data logger + converter via serial line",
		3 => "Data Logger + counter via pulses",
		4 => "Data logger + counter via serial line",
		5 => "Data logger integrated with the converter",
	);

	$status = hexdec(substr_cut($value, 1));
	return dechex($status). " - ". $metering_type_text[$status];
}

function ctr_seal($value)
{
	$seal_text = array(
		 0 => array( "", ""),
		 1 => array( "Event log reset seal", "The event log cannot be deleted"),
		 2 => array( "Seal for restoring factory conditions", "Reset not possible (the relative command is refused)"),
		 3 => array( "Seal for restoring the default values", "The default values of the parameters cannot be restored (the relative command is refused)"),
		 4 => array( "Status change seal", "The status cannot be changed (the relative command is refused)"),
		 5 => array( "", ""),
		 6 => array( "", ""),
		 7 => array( "", ""),
		 8 => array( "", ""),
		 9 => array( "Remote configuration seal. Volume conversion parameters (e.g.:weight, pulse, formulas, references, etc.) excluding analysis parameters", "Remote configuration of volume conversion parameters is not allowed"),
		10 => array( "Remote configuration seal; Parameters. Analysis (e.g. COS, N2, density, etc.)", "Remote configuration of gas quality parameters is not allowed"),
		11 => array( "Seals for downloading the program", "Downloading the software is not allowed (the relative command is rejected)"),
		12 => array( "Seal for restoring the default passwords", "The default values of the password cannot be restored (the relative command is rejected)"),
	);
	
	$answer[] = $value;
	$value = hexdec($value);
	
	for($i=0; $i<count($seal_text); $i++)
	{
		$bit = 1 << $i;
		if(($value & $bit ) 
		&& ($seal_text[$i][0] != "")) 
			$answer[] = sprintf("%08d %08d", decbin($bit>>8), decbin($bit & 0xFF)) . " - ". $seal_text[$i][($value & $bit)? 0:1];
	}
	return $answer;
}

function ctr_frequency_text($p_mese)
{
	$p_mese_text = array(
			array(0,	0,	"Disabled"),
			array(1,   31,	"On the day of the month indicated"),
			array(32,  39,	"Reserved"),
			array(40,  55,	"Once every x days from the 1st day of the month2 (if x=0 day 1 and 15) ) (e.g. :x=15 day 1, 15 and 30 (where applicable); x=1 every day; x= 2 alternate days starting from and inclusive of day 1)"),
			array(56,  80,	"Reserved"),
			array(81,  81,	"On closure of the billing period for any reason"),
			array(82,  89,	"Reserved"),
			array(90, 105,	"Once every x days from the 1st day of the month (x=0 only the 1st day of the month)2 and on closure of the billing period for any reason"),
			array(255,255,	"Reserved for alarm SMS"),
	);

	$p_mese_answer = "";
	foreach ($p_mese_text as $p_mese_text_line)
	{
		if( $p_mese_text_line[0] <= $p_mese && $p_mese <= $p_mese_text_line[1])
			$p_mese_answer = $p_mese_text_line[2];
	}
	return $p_mese_answer;
}

function ctr_inbound($value)
{
	$method_text = array(
		0 => "Sequential (e.g.: 1,1,1-2,2,2-3.3.3 ...-8.8.8)",
		1 => "Cyclic (e.g.:1,2 3,4,5,6,7,8-1,2,3,4.5,6,7,8.)",
	);
				
	$p_mese = hexdec(substr_cut($value, 1));
	$delay  = hexdec(substr_cut($value, 2));
	$method = hexdec(substr_cut($value, 1));
	$retry  = hexdec(substr_cut($value, 1));
	
	$answer[] = "$p_mese - ". ctr_frequency_text($p_mese);
	$answer[] = ctr_wake_up_time($delay) ." - Delay (without gas hour)";
	$answer[] = "$method - ". $method_text[$method];
	$answer[] = "$retry - Retry";
	
	return $answer;
}

function ctr_cmode($value)
{
	$cmode_text = array(
		0 => "SMS supported",
		1 => "DATA supported",
		2 => "GPRS supported (TCP/IP)",
		3 => "Fax supported",
		4 => "E-mail supported",
		5 => "GPRS supported (UDP/IP)",
		6 => "GPRS- TCP/IPV6 supported",
		11 => "INBOUND mode supported",
	);
	
	$value = hexdec($value);
	return $value ." - ". $cmode_text[$value];
}

function ctr_ip_address(&$value)
{
	$ip1 = hexdec(substr_cut($value,1));
	$ip2 = hexdec(substr_cut($value,1));
	$ip3 = hexdec(substr_cut($value,1));
	$ip4 = hexdec(substr_cut($value,1));
	
	return "$ip1.$ip2.$ip3.$ip4";
}

function ctr_dce($value)
{
	$tipo_text = array(
		0x00 => "None",
		0x01 => "PSTN Telephone number",
		0x02 => "GSM and SMS telephone number",
		0x03 => "SMS/GSM/GPRS Telephone num",
		0x04 => "ADSL",
		0x05 => "ISDN",
		0x06 => "Ethernet",
		0x07 => "Wireless Router",
		0x08 => "PLC Router",
		0x09 => "Dedicated",
		0x0A => "GPRS-TCP/IP",
		0x0B => "GSM (data)",
		0x0C => "SMS (only)",
		0x0D => "GPRS - TCP/IPV6",
		0x0E => "SMS/GSM/GPRSIPV6",
	);
	
	$ippt_text = array(
		0 => "Not defined GPRS not supported",
		1 => "TCP",
		2 => "UDP",
		3 => "FTP",
		4 => "SMTP",
		5 => "HTTP",
		6 => "Reserved",
		7 => "POP3",
	);
	
	$tipo = hexdec(substr_cut($value, 1));
	$answer[] = dechex($tipo). " - ". $tipo_text[$tipo];
	
	switch( $tipo )
	{
		case 0x01:
		case 0x02:
		case 0x0B:
		case 0x0C:
			$answer[] = hexToStr($value) ." - telephone number";
			break;
		case 0x03:
			$answer[] = hexToStr(substr_cut($value,14)) ." - telephone number";
			$ippt = hexdec(substr_cut($value,1));
			$answer[] = $ippt ." - ". $ippt_text[$ippt];
			$answer[] = ctr_ip_address($value);
			break;
		case 0x0A:
			$ippt = hexdec(substr_cut($value,1));
			$answer[] = $ippt ." - ". $ippt_text[$ippt];
			$answer[] = ctr_ip_address($value);
			break;
		case 0x0D:
			$ippt = hexdec(substr_cut($value,1));
			$answer[] = $ippt ." - ". $ippt_text[$ippt];
			$answer[] = ctr_ip_address($value) .":". hexdec(substr_cut($value,2));
			break;
		case 0x0E:
			$answer[] = hexToStr(substr_cut($value,14)) ." - telephone number";
			$ippt = hexdec(substr_cut($value,1));
			$answer[] = $ippt ." - ". $ippt_text[$ippt];
			$answer[] = ctr_ip_address($value) .":". hexdec(substr_cut($value,2));
			break;
		default:
			$value = trim(hexToStr($value));
			if( !empty($value))
				$answer[] = $value;
			break;
			
	}
	return $answer;
}

function ctr_tlv($value)
{
	$tlv_text = array(
		0 => "Remote notification function disabled",
		1 => "Without ACK reply",
		2 => "With ACK reply",
	);
	
	$tlv = hexdec(substr_cut($value, 1));
	$answer[] = $tlv. " - ". $tlv_text[$tlv];
	return $answer;
}

function ctr_wake_up_time($time)
{
	$hour   = floor($time / 3600);	$time %= 3600;
	$minute = floor($time / 60);	$time %= 60;
	$second = $time;
	
	return sprintf("%02d:%02d:%02d", $hour, $minute, $second); 
}

function ctr_wake_up($value)
{
	$mode_text = array(
		0 => "Available",
		1 => "Reserved",
		2 => "WUIP-OUT (if the DCE supports a type of IP communication)",
		3 => "SMS and/or Data (according to the vectors supported by the DCE)",
		4 => "DCE_1",
		5 => "DCE_2",
		6 => "DCE_3",
		7 => "DCE_4",
	);
	
	$on     = hexdec(substr_cut($value, 2));
	$off    = hexdec(substr_cut($value, 2));
	$p_mese = hexdec(substr_cut($value, 4));
	$mode   = hexdec(substr_cut($value, 1)); 
	
	$answer[] = ($on == 0xFFFF)? "FFFF - always ON": (ctr_wake_up_time($on). " - ON");
	$answer[] = ($off == 0xFFFF)? "FFFF - communication always returns to being OFF after the first ON": (ctr_wake_up_time($off). " - OFF");
	$answer[] = sprintf("%08d %08d %08d %08d", decbin(($p_mese >> 24) & 0xFF), decbin(($p_mese >> 16) & 0xFF)
			                                 , decbin(($p_mese >> 8) & 0xFF), decbin($p_mese & 0xFF)) ." - Days 31-1";

	// mode
	for($i=0; $i<8; $i++)
	{
		$bit = 1 << $i;
		if( $mode & $bit )
			$answer[] = dechex($bit). "h - ". $mode_text[$i];
	}
	
	$answer[] = hexdec(substr_cut($value, 1)). ":".	hexdec(substr_cut($value, 1)). " - Start of window weekdays";
	$answer[] = hexdec(substr_cut($value, 1)). ":".	hexdec(substr_cut($value, 1)). " - End of window weekdays";
	$answer[] = hexdec(substr_cut($value, 1)). ":".	hexdec(substr_cut($value, 1)). " - Start of window holidays";
	$answer[] = hexdec(substr_cut($value, 1)). ":".	hexdec(substr_cut($value, 1)). " - End of window holidays";

	return $answer;
}

function ctr_voluntary($value)
{
	for($i=0; $i<6; $i++)
	{
		$struct_id = hexdec(substr_cut($value, 1));
		$obj_id    = ctr_obj_number(substr_cut($value, 2));
		$p_mese    = hexdec(substr_cut($value, 1));
/*		
		$answer[] = ctr_struct_name($struct_id)
				  . " ("
				  . ctr_obj_name($obj_id)
				  . ", "
				  . "$p_mese - ". ctr_frequency_text($p_mese)
				  . ")";
*/
		$answer[] = "Spont_$i";
		$answer[] = ctr_struct_name($struct_id);
		$answer[] = ctr_obj_name($obj_id);
		$answer[] = "$p_mese - ". ctr_frequency_text($p_mese);
		if( $i != 5 )
			$answer[] = "";
	}
	return $answer;
}

function ctr_near_null($value)
{
	$count = 0;
	while( !empty($value))
	{
		if( substr_cut($value,1) == "00")
			break;
		$count++;
	}
	return $count;
}

function ctr_gprs_set($value)
{
	$torr     = substr_cut($value, 1);
	$apn      = hexToStr(substr_cut($value, ctr_near_null($value)));	substr_cut($value, 1);
	$login    = hexToStr(substr_cut($value, ctr_near_null($value)));	substr_cut($value, 1);
	$password = hexToStr(substr_cut($value, ctr_near_null($value)));	substr_cut($value, 1);
	$port     = hexToStr(substr_cut($value, ctr_near_null($value)));	substr_cut($value, 1);
	
	$answer[] = $torr ." - Torr (minutes)";
	$answer[] = $apn ." - APN";
	$answer[] = $login ." - Login";
	$answer[] = $password ." - Password";
	$answer[] = $port ." - Port";
	return $answer;
}

function ctr_ID_PT($value)
{
	$answer[] = substr_cut($value, 2). "h - ID_PTc (current tariff scheme id)";
	$answer[] = substr_cut($value, 2). "h - ID_PTpre (previous tariff scheme id)";
	$answer[] = substr_cut($value, 2). "h - ID_PTf (future tariff scheme id)";
	$answer[] = ctr_date( substr_cut($value, 3),3). " - DEV (Date from which applicable)";
	return $answer;	
}

function ctr_Conf_P($value)
{
	$conf_p_type = array(
		0 => "Does not exist",
		1 => "(4-20) mA",
		2 => "(0-20) mA",
		3 => "Volt",
		4 => "HART",
	);
	$type = hexdec($value);
	$answer[] = $type . " - ". $conf_p_type[$type];
	return $answer;
}

function ctr_Conf_T($value)
{
	$conf_p_type = array(
			0 => "Does not exist",
			1 => "(4-20) mA",
			2 => "volt",
			3 => "PT100",
			4 => "PT500",
			5 => "PT1000",
			6 => "HART",
	);
	$type = hexdec($value);
	$answer[] = $type . " - ". $conf_p_type[$type];
	return $answer;
}

function ctr_sd($value)
{
	$sd_type = array(
			0 => "to be configured",
			1 => "normal",
			2 => "under maintenance",
	);
	$status = hexdec($value);
	$answer[] = ($status & 0x3F) . " - ". $sd_type[$status & 0x3F];
	
	if( $status & 0x40 ) $answer[] = "6bit - server with configuration session active";
	if( $status & 0x80 ) $answer[] = "7bit - temporary encryption key of the administrator profile";
	return $answer;
}

function ctr_sens_stat($value)
{
	$stat_element = array(
		"Press_mis",
		"Temp",
		"DeltaPh",
		"DeltaPi",
		"Press_in",
		"Contatore",
		"Convertitore",
		"Dens",
		"Gascrom",			
	);
	$stat_type = array(
		0 => "does not exist",
		1 => "operating correctly",
		2 => "operating intermittently",
		3 => "failure",
		4 => "values are not reliable",
		5 => "not communicating",
		6 => "alarm",			
	);
	
	foreach ($stat_element as $stat_element_line) {
		$type = hexdec(substr_cut($value, 1));
		$answer[] = $stat_element_line ." - ". $stat_type[$type] ." ($type)";
	}
	
	return $answer;
}

function ctr_PT_decomp($value)
{
	$interval_text = array(
		"Weekdays",
		"Saturdays",
		"Holidays",
	);
	
	$month = hexdec(substr_cut($value, 1));
	$day   = hexdec(substr_cut($value, 1));
	$answer[] = " $day.$month.20XX - Start day.month.year";
	
	foreach ($interval_text as $interval_line)
	{
		$answer[] = " ". $interval_line;
		for($i=0; $i<5; $i++)
		{
			$interval = hexdec(substr_cut($value, 1));
			$band = $interval >> 6;
			$hour = $interval & 0x3F;
			$answer[] = "  $band band - $hour hour";
		}
	}
	 
	return $answer;
}

function ctr_PT($value)
{
	$afi_mode = array(
		0 => "1 January",
		1 => "6 January",
		2 => "Easter Monday - As per Gregorian Calendar",
		3 => "25 April",
		4 => "1 May",
		5 => "2 June",
		6 => "15 August",
		7 => "1 November",
		8 => "8 December",
		9 => "25 December",
		10 => "26 December",
	);
	
	$special_days_text = array(
		0 => "not present",
		1 => "band 1 for the whole day",
		2 => "band 2 for the whole day",
		3 => "band 3 for the whole day",
		4 => "as weekdays",
		5 => "as Saturdays",
		6 => "as holidays",
		7 => "default band for the whole day",
	);
	
	$APT = hexdec(substr_cut($value, 1));
	$ID_PT = substr_cut($value, 2);
	$DEV = substr_cut($value, 3);
	$FTD = hexdec(substr_cut($value, 1)); 
	$PT1 = substr_cut($value, 17); 
	$PT2 = substr_cut($value, 17);
	$AFI = hexdec(substr_cut($value, 2));
	$GP  = $value; 
	
	$answer[] = $APT ." - APT (Tariff Scheme 1-Enabled/0-Disabled)";
	$answer[] = $ID_PT ."h - ID_PT (Tariff scheme identifier)";
	$answer[] = ctr_date($DEV,3). " - DEV (Date from which applicable)";
	$answer[] = $FTD ." - FTD (Default price band)";
	$answer[] = "PT1 - Descriptor for period 1";
	foreach (ctr_PT_decomp($PT1) as $PT1_line) $answer[] = $PT1_line;
	$answer[] = "PT2 - Descriptor for period 2";
	foreach (ctr_PT_decomp($PT2) as $PT2_line) $answer[] = $PT2_line;
		
	$answer[] = dechex($AFI) ."h - AFI (Enabled on weekday public holidays)";
	for($i=0; $i<count($afi_mode); $i++) {
		$bit = 1 << $i;
		if( $bit & $AFI )
			$answer[] = sprintf(" %08d %08d - %s", decbin(($bit >> 8) & 0xFF), decbin($bit & 0xFF), $afi_mode[$i]);
	}
	
	$answer[] = "GP (Special Days)";
	for($i=0; $i<15; $i++) {
		$byte1 = hexdec(substr_cut($GP, 1));		
		$byte2 = hexdec(substr_cut($GP, 1));
		$month = $byte1 & 0x0F;
		$day   = $byte2 & 0x1F;
		$answer[] = "  $day.$month.20XX, ". ($byte1 >> 5) ." - " .$special_days_text[$byte1 >> 5];		
	}
	
	return $answer;
}

function ctr_F_PT($value)
{
	$id_pt = substr_cut($value, 1);
	$answer[] = "$id_pt - PT";
	foreach (ctr_PT($value) as $pt_line)
		$answer[] = $pt_line;
	
	return $answer;
}

function ctr_F_AKT($value)
{
	$act = substr_cut($value, 1);
	$hour = substr_cut($value, 1);
	
	$act_text = "";
	if( $act == "01" ) $act_text = "KEYT active";
	if( $act == "10" ) $act_text = "KEYT disabled";
	
	$answer[] = "$act - $act_text"; 
	$answer[] = "$hour - hour";
	return $answer; 
}

function ctr_F_Call($value)
{
	$mode_text = array(
			0 => "Does not exist",
			1 => "SMS reading",
			2 => "GPRS Inbound",
			3 => "GSM callback",
	);
	
	$DCE  = substr_cut($value, 1);
	$mode = substr_cut($value, 1);
	
	$answer[] = $DCE. " - DCE";
	$answer[] = $mode. " - ". $mode_text[hexdec($mode)];
	return $answer;
}

function ctr_data_SW($value)
{
	$data_SW_text = array(
			0 => "Does not exist",
			1 => "Vendor",
			2 => "Contract",
			3 => "Client (transfer)",
			4 => "Distributor",
			5 => "Reserved",
	);
	$reason = hexdec($value);
	$answer[] = $reason. " - ". $data_SW_text[($reason >= 5)? 5: $reason]; 
	return $answer;
}

function ctr_PerFat($value)
{
	$day    = hexdec(substr_cut($value, 1));	
	$period = hexdec(substr_cut($value, 1));	
	$month  = hexdec(substr_cut($value, 1));
		
	$answer[] = $day. " - Day"; 
	$answer[] = $period. " - Period (1,2,3,4,6)"; 
	$answer[] = $month. " - Month";
	return $answer; 
}

function ctr_status($value)
{
	$status_bit_text = array(
		 0 => "Mains power not available",
		 1 => "Low battery",
		 2 => "Event log at 90%",
		 3 => "General alarm",
		 4 => "Connection with emitter or converter broken",
		 5 => "Event log full",
		 6 => "Clock misalignment",
		 7 => "Converter alarm",
		 8 => "Temperature out of range",
		 9 => "Pressure out of range",
		10 => "Meter flow over limit",
		11 => "Valve closing error",
		12 => "Valve opening error",
		13 => "Battery capacity modem is under <10%",
		14 => "Battery modem voltage <3V, or communication error",
	);

	$answer[] = "$value h";
	$value = hexdec($value);
	
	for($i=0; $i<count($status_bit_text); $i++)
	{
		$bit = 1 << $i;
		if( $value & $bit )
			$answer[] = sprintf("%08d %08d - %s", decbin(($bit >> 8) & 0xFF), decbin($bit & 0xFF), $status_bit_text[$i]);
	}
	return $answer;
}

function ctr_traces_list($value)
{
	for($i=0; $i<16; $i++)
	{
		$obj_id = ctr_obj_number(substr_cut($value, 2));
		$answer[] = ctr_obj_name($obj_id);
	} 
	return $answer;
}

function ctr_array_list($value)
{
	$type_text = array(
		0 => "reserved",
		1 => ".qlf, .date&time, .val",
		2 => ".qlf, .val",
		3 => ".val",
		4 => ".date&time, .val",
	);
	
	for($i=0; $i<16; $i++)
	{
		$type = hexdec(substr_cut($value, 1));
		$obj_id = ctr_obj_number(substr_cut($value, 2));
		$answer[] = ctr_obj_name($obj_id);
		$answer[] = " ". $type_text[$type];
	} 
	return $answer;
}
/*----------------------------------------------------------------------------*/
/* END OF FILE */
