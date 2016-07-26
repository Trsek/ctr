<?php
require_once("obj/objects.php");

function ctr_Query($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$answer[] = "$password - Access level password";
	$answer[] = $DATI;
	return $answer;
}

function ctr_Answer($DATI)
{
	$pdr        = substr_cut($DATI, 7);
	$anti_fraud = ctr_val($DATI, "D.A.0", 0x03)[0][0];
	$index_A    = hexdec( substr_cut($DATI, 2));
	$mem        = hexdec( substr_cut($DATI, 2));
	
	$answer[] = $pdr ." - PDR (metering point identification code)";
	$answer[] = "$anti_fraud - Anti-Fraud";
	$answer[] = "$index_A - Index_A";
	$answer[] = "$mem - MEM";
	
	// Evento
	$answer[] = "";
	$answer[] = "Event :";
	for($i=0; $i<2; $i++)
	{
		$answer[] = ctr_date(substr_cut($DATI, 5), 6);
		$answer[] = substr_cut($DATI, 2) ." - ID_PT";

		$answer[] = ctr_obj_name("2.5.0");		$answer[] = ctr_val($DATI, "2.5.0", 0x03);
		$answer[] = ctr_obj_name("2.5.1");		$answer[] = ctr_val($DATI, "2.5.1", 0x03);
		$answer[] = ctr_obj_name("2.5.2");		$answer[] = ctr_val($DATI, "2.5.2", 0x03);
		$answer[] = ctr_obj_name("2.3.7");		$answer[] = ctr_val($DATI, "2.3.7", 0x03);
		$answer[] = ctr_obj_name("2.3.8");		$answer[] = ctr_val($DATI, "2.3.8", 0x03);
		$answer[] = ctr_obj_name("2.3.9");		$answer[] = ctr_val($DATI, "2.3.9", 0x03);
		$answer[] = "";
	}

	$answer[] = $DATI;
	return $answer;
}

