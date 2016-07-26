<?php
require_once("obj/objects.php");

function ctr_Write($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$dv     = ctr_date(substr_cut($DATI, 3), 3);
	$wdb    = hexdec( substr_cut($DATI, 1));
	$p_ses  = hexdec( substr_cut($DATI, 1));

	$KEYF   = substr_cut($DATI, 16);
	$DEV_Kf = ctr_date(substr_cut($DATI, 3), 3);
	$KEYC_0 = substr_cut($DATI, 16);
	$DEV_Kc = ctr_date(substr_cut($DATI, 3), 3);
	$KEYT   = substr_cut($DATI, 16);
	$DEV_Kt = ctr_date(substr_cut($DATI, 3), 3);
	
	$answer[] = "$password - Access level password";
	$answer[] = "$dv - Date of validity of the command";
	$answer[] = "$wdb - Writing Data Block";
	$answer[] = "$p_ses - Configuration session";

	$answer[] = "";
	$answer[] = "Factory Key KEYF";
	$answer[] = $KEYF;
	$answer[] = "$DEV_Kf - Date of activation";
	$answer[] = "";
	$answer[] = "Service KeyC_0";
	$answer[] = $KEYC_0;
	$answer[] = "$DEV_Kc - Date of activation";
	$answer[] = "";
	$answer[] = "Temporaty Key KEYT";
	$answer[] = $KEYT;
	$answer[] = "$DEV_Kt - Date of activation";
	
	$answer[] = "";
	$answer[] = $DATI;
	return $answer;
}
