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
	return $value;
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
			$answer .= substr_cut($value, 1);
			break;
		case 0x35:
		case 0x3D:
		case 0x38:
			substr_cut($value, 1);
			$answer .= ctr_date( substr_cut($value, 3),3);
			$answer .= " day=". substr_cut($value, 1);
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
			$answer .= hexbin(substr_cut($value, 5));
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
			$answer .= hexbin( substr_cut($value, 4));
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

/*----------------------------------------------------------------------------*/
/* END OF FILE */
