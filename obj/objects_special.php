<?php

function ctr_db($value)
{
	$value = hexdec($value);
	if( $value & 0x80 )
		$value = (-1)*(128 - ($value & 0x7F));
	return $value;
}

function ctr_call_map($value)
{
	return $value;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
