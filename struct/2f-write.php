<?php
require_once("obj/objects.php");

function ctr_Write($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$dv       = ctr_date(substr_cut($DATI, 3), 3);
	$wdb      = hexdec( substr_cut($DATI, 1));
	$p_ses    = hexdec( substr_cut($DATI, 1));
	$obj      = hexdec( substr_cut($DATI, 1));
	$attw     = hexdec( substr_cut($DATI, 1));
	
	$answer[] = "$password - Access level password";
	$answer[] = "$dv - Date of validity of the command";
	$answer[] = "$wdb - Writing Data Block";
	$answer[] = "$p_ses - Configuration session";
	$answer[] = "$obj - Number of objects to be write";
	$answer[] = ctr_attw($attw);
	
	for($i=0; $i<$obj; $i++)
	{
		$obj_id = ctr_obj_number(substr_cut($DATI, 2));
		$answer[] = ctr_obj_name($obj_id);
		$answer[] = ctr_val($DATI, $obj_id, $attw);
	}
	$answer[] = $DATI;
	return $answer;
}


function ctr_Write_Table($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$dv       = ctr_date(substr_cut($DATI, 3), 3);
	$wdb      = hexdec( substr_cut($DATI, 1));
	$p_ses    = hexdec( substr_cut($DATI, 1));
	$table_id = hexdec( substr_cut($DATI, 1));
	$count    = hexdec( substr_cut($DATI, 2));
	
	$answer[] = "$password - Access level password";
	$answer[] = "$dv - Date of validity of the command";
	$answer[] = "$wdb - Writing Data Block";
	$answer[] = "$p_ses - Configuration session";
	$answer[] = ctr_struct_name($table_id);
	$answer[] = "$count - Count";
	$answer[] = "";
	
	for($i=0; $i<$count; $i++)
	{
		$obj_id = ctr_obj_number(substr_cut($DATI, 2));
		$attw  = hexdec( substr_cut($DATI, 1));
		$answer[] = ctr_obj_name($obj_id);
		$answer[] = ctr_attw($attw);
	}
	$answer[] = $DATI;
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
