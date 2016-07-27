<?php
require_once("obj/objects.php");

function ctr_Query($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$index_Q  = hexdec( substr_cut($DATI, 2));

	$answer[] = "$password - Access level password";
	$answer[] = "$index_Q - Index_Q";
	
	$answer[] = $DATI;
	return $answer;
}

function ctr_Answer($DATI)
{
	$pdr      = substr_cut($DATI, 7);
	$anti_fraud = ctr_val($DATI, "D.A.0", 0x03)[0][0];
	$index_A  = hexdec( substr_cut($DATI, 2));
	$mem      = hexdec( substr_cut($DATI, 2));
	
	$answer[] = $pdr ." - PDR (metering point identification code)";
	$answer[] = "$anti_fraud - Anti-Fraud";
	$answer[] = "$index_A - Index_A";
	$answer[] = "$mem - MEM";
	
	// Evento
	$answer[] = "";
	$answer[] = "Event Trigger :";
	for($i=0; $i<6; $i++)
	{
		$answer[] = ctr_date(substr_cut($DATI, 5), 6);
		$answer[] = substr_cut($DATI, 2) ." - ID_PT";
		$answer[] = substr_cut($DATI, 1) ." - Code";
		$answer[] = substr_cut($DATI, 5) ." - Field1";
		$answer[] = substr_cut($DATI, 4) ." - Field2";
		$answer[] = "";
	}

	$answer[] = $DATI;
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
