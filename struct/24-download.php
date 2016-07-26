<?php
require_once("obj/objects.php");

function ctr_Write($DATI)
{
	$dv       = ctr_date(substr_cut($DATI, 3), 3);
	$wdb      = hexdec( substr_cut($DATI, 1));
	$identify = hex2bin( substr_cut($DATI, 4));
	$group_s  = substr_cut($DATI, 1);
	$group_c  = substr_cut($DATI, 1);
	$segment  = substr_cut($DATI, 2);
	
	$answer[] = "$dv - Date of validity of the command";
	$answer[] = "$wdb - Writing Data Block";
	$answer[] = "$identify - Software identifier";
	$answer[] = "$group_s - Group identifier";
	$answer[] = "$group_c - SubGroup identifier";
	$answer[] = "$segment - Code segment";
	
	// additional information
	if( $group_s == "00" || $group_c == "00" )
	{
		$answer[] = ctr_date(substr_cut($DATI,3),3) ." - Date activation";
		$answer[] = hex2bin( substr_cut($DATI,5)) ." - CIA";
		$answer[] = hex2bin( substr_cut($DATI,6)) ." - VF";
		$answer[] = hexdec( substr_cut($DATI,4)) ." - LS (Length of software in bytes)";
		$answer[] = hexdec( substr_cut($DATI,2)) ." - NS (Number of total segments)";
	}
	
	$answer[] = $DATI;
	return $answer;
}
