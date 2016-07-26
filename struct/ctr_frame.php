<?php
require_once("struct/ctr_frame.inc");
require_once("obj/objects.inc");

function ctr_Query2($DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$answer[] = "$password - Access level password";
	$answer[] = $DATI;
	return $answer;
}

// parse frame
function ctr_parse_frame(&$DATI, $frame_id)
{
	global $TABLE_FRAME_DEF;
	
	$frame = $TABLE_FRAME_DEF[$frame_id];
	$answer = "";
	
	foreach ($frame as $frame_line)
	{
		$obj_id = $frame_line[CTR_TABLE_OBJ_ID];
		$answer[] = ctr_obj_name($obj_id);	
		$answer[] = ctr_val($DATI, $obj_id, $frame_line[CTR_TABLE_ATTW]);	
	}
	return $answer;
}