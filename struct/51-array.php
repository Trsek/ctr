<?php
require_once("obj/objects.php");

function ctr_Query(&$DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$obj_id   = ctr_obj_number(substr_cut($DATI, 2));
	$index_Q  = hexdec( substr_cut($DATI, 2));
	$counter_Q= hexdec( substr_cut($DATI, 1));

	$answer[] = "$password - Access level password";
	$answer[] = ctr_obj_name($obj_id);
	$answer[] = "$index_Q - Index_Q";
	$answer[] = "$counter_Q - Counter_Q";
	return $answer;
}

function ctr_Answer(&$DATI)
{
	$obj_id   = ctr_obj_number(substr_cut($DATI, 2));
	$type     = hexdec( substr_cut($DATI, 1));
	$index_A  = hexdec( substr_cut($DATI, 2));
	$counter_A= hexdec( substr_cut($DATI, 1));
	$coda     = hexdec( substr_cut($DATI, 2));
	
	$answer[] = ctr_obj_name($obj_id);
	$answer[] = "$type - Type";
	$answer[] = "$index_A - Index_A";
	$answer[] = "$counter_A - Counter_A";
	
	// Trace_dati
	$answer[] = "";
	$answer[] = "Array :";
	$answer[] = ctr_obj_name($obj_id);
	
	for($i=0; $i<$counter_A; $i++)
	{
		switch( $type )
		{
			case 1:
				$line = ctr_val($DATI, $obj_id, 0x03);
				$info = ctr_qlf_valid($line[1])? "": " (". trim($line[1]) .")";
				$answer[] = $index_A++ ." - ". $line[0][0]. $info;
				$answer[] = ctr_date(substr_cut($DATI, 5), 5);
				break;
			case 2:
				$line = ctr_val($DATI, $obj_id, 0x03);
				$info = ctr_qlf_valid($line[1])? "": " (". trim($line[1]) .")";
				$answer[] = $index_A++ ." - ". $line[0][0]. $info;
				break;
			case 3:
				$answer[] = ctr_val($DATI, $obj_id, 0x02);
				break;
			case 4:
				$answer[] = ctr_date(substr_cut($DATI, 5), 5);
				$answer[] = $index_A++ ." - ". ctr_val($DATI, $obj_id, 0x02);
				break;
		}
	}
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
