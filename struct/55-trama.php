<?php
require_once("struct/struct_name.php");
require_once("obj/objects.php");

function ctr_Query($DATI)
{
	$password    = hex2bin( substr_cut($DATI, 6));
	$struct_code = hexdec( substr_cut($DATI, 1));
	
	$answer[] = "$password - Access level password";
	$answer[] = ctr_struct_name($struct_code);
	$answer[] = $DATI;
	return $answer;
}

function ctr_Answer($DATI)
{
	$struct_code = hexdec( substr_cut($DATI, 1));
	$obj = hexdec(substr_cut($DATI, 1));
		
	$answer[] = ctr_struct_name($struct_code);
	$answer[] = (string)$obj. " - Number of objects in the structure";
	
	$answer[] = "";
	for($i=0; $i<$obj; $i++)
	{
		$obj_id   = ctr_obj_number(substr_cut($DATI, 2));
		$obj_type = substr_cut($DATI, 1);
		$answer[] = ctr_obj_name($obj_id);
		$answer[] = "$obj_type - attw";
		$answer[] = "";
	}
	$answer[] = $DATI;
	return $answer;
}

