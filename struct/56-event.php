<?php
require_once("obj/objects.php");

function ctr_Query_56(&$DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$index_Q  = hexdec( substr_cut($DATI, 2));

	$answer[] = "$password - Access level password";
	$answer[] = "$index_Q - Index_Q";
	return $answer;
}

function ctr_Answer_56(&$DATI)
{
	$pdr      = substr_cut($DATI, 7);
	$anti_fraud = trim(ctr_val($DATI, "D.A.0", 0x03)[0][0]);
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
		$answer[] = ctr_val($DATI, "10.0.1", 0x02);
	}
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
