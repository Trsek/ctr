<?php
require_once("struct/struct_name.php");
require_once("obj/objects.php");

function ctr_tipo_name($tipo_code)
{
	$tipo_text =
	array(  'Not used',
			'List of optional Functions',
			'List of optional Data structures',
			'List of optional Execute Functions',
			'List of Private Functions',
			'List of Private Data structures',
			'List of Private Execute Functions',
	);
	
	if( $tipo_code > 0x10 )
		$tipo_code = $tipo_code - 0x10 + 4;
	
	return dechex($tipo_code) ."h - " .$tipo_text[$tipo_code]; 
}

function ctr_Query_54(&$DATI)
{
	$password  = hex2bin( substr_cut($DATI, 6));
	$tipo_code = hexdec( substr_cut($DATI, 1));
	
	$answer[] = "$password - Access level password";
	$answer[] = ctr_tipo_name($tipo_code);
	return $answer;
}

function ctr_Answer_54(&$DATI)
{
	$tipo_code = hexdec( substr_cut($DATI, 1));
	$obj = hexdec(substr_cut($DATI, 1));
		
	$answer[] = ctr_tipo_name($tipo_code);
	$answer[] = (string)$obj. " - Number of elements";
	
	$answer[] = "";
	for($i=0; $i<$obj; $i++)
	{
		$obj_id = substr_cut($DATI, 2);
		switch($tipo_code)
		{
			case 1:
			case 0x11:
				$answer[] = ctr_funct_name(hexdec($obj_id));
				break;
			case 2:
			case 0x12:
				$answer[] = ctr_struct_name(hexdec($obj_id));
				break;
			case 3:
			case 0x13:
				$answer[] = ctr_obj_name(ctr_obj_number($obj_id));
				break;
		}
	}
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
