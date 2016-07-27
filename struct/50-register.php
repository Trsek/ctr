<?php
require_once("obj/objects.php");

function ctr_Query($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$obj      = hexdec( substr_cut($DATI, 1));
	$attw     = hexdec( substr_cut($DATI, 1));
	
	$answer[] = "$password - Access level password";
	$answer[] = "$obj - Number of objects to be read";
	$answer[] = ctr_attw($attw);
	
	for($i=0; $i<$obj; $i++)
	{
		$answer[] = ctr_obj_name( ctr_obj_number(substr_cut($DATI, 2)));
	}
	$answer[] = $DATI;
	return $answer;
}

function ctr_Answer($DATI)
{
	$obj  = hexdec( substr_cut($DATI, 1));
	$attw = hexdec( substr_cut($DATI, 1));
	
	$answer[] = "$obj - Number of objects to be sent";
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

/*----------------------------------------------------------------------------*/
/* END OF FILE */

