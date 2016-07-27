<?php
require_once("obj/objects.php");

function ctr_Execute(&$DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$dv       = ctr_date(substr_cut($DATI, 3), 3);
	$wdb      = hexdec( substr_cut($DATI, 1));
	$obj_id   = ctr_obj_number(substr_cut($DATI, 2));
	
	$answer[] = "$password - Access level password";
	$answer[] = "$dv - Date of validity of the command";
	$answer[] = "$wdb - Writing Data Block";
	$answer[] = ctr_obj_name($obj_id);
	$answer[] = ctr_val($DATI, $obj_id, 0x02);

	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
