<?php
require_once("struct/ctr_frame.php");

function ctr_Query(&$DATI)
{
	$st_text = array(
			"Not defined",
			"Remote client",
			"Terminal",
	);
	
	$puk_s    = substr_cut($DATI, 8);
	$st       = hexdec( substr_cut($DATI, 1));
	$code_st  = hexdec( substr_cut($DATI, 1));

	$answer[] = "$puk_s - PUK_S";
	$answer[] = (string)$st ." - ". $st_text[$st];
	$answer[] = "$code_st - Identifier of the remote Client or of the terminal";
	return $answer;
}

function ctr_Answer(&$DATI, $sms_struct)
{
	return ctr_parse_frame($DATI, $sms_struct);
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
