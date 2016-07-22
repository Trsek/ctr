<?php
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

// zaciatok merania
function start_meas()
{
global $time_meas_start;
global $time_meas_part;

    $time_meas_part = $time_meas_start = microtime_float();
}

// koniec merania - ako dlho to trvalo
function stop_meas()
{
global $time_meas_start;

	$time = microtime_float() - $time_meas_start;
	return number_format($time, 3);
}

// medzicas
function part_meas()
{
global $time_meas_part;

	$time = microtime_float() - $time_meas_part;
	$time_meas_part = microtime_float();
	return number_format($time, 3);
}

// zacni meranie
start_meas();

?>
