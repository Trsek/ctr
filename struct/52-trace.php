<?php
require_once("obj/objects.php");

define (DEFAULT_GAS_HOUR, 6);	// OFG

function get_period_text_trace()
{
	$period_text = 
		array('period incorrect',
			  '15min trace Y,m,d,q (quartes of an hour on the day specified)',
		      '1hour trace Y,m,d,h (the hours on the day specified)',
		      '1day trace Y,m,d,0 (the daily records on the day specified)',		
	          '1month trace Y,m,0,0 (monthly records on the month specified)',
	          '1year trace Y,0,0,0 (annual records on the given year)',
	          'period other'
		);
		
	return $period_text;
}
	
function ctr_Query($DATI)
{
	$password   = hex2bin( substr_cut($DATI, 6));
	$obj_id     = ctr_obj_number(substr_cut($DATI, 2));
	$period     = hexdec( substr_cut($DATI, 1));
	$data_start = substr_cut($DATI, 4);
	$elementi   = hexdec( substr_cut($DATI, 1));

	$answer[] = "$password - Access level password";
	$answer[] = ctr_obj_name($obj_id);
	$answer[] = (string)$period. " - ". get_period_text_trace()[($period < 6)? $period: 6];
	$answer[] = ctr_date($data_start,4). " - Data_start";
	$answer[] = "$elementi - Elementi";
	
	$answer[] = $DATI;
	return $answer;
}

/********************************************************************
 * @brief Shift date/time acording period
 */
function ctr_get_period_shift_trace($trace_date, $period, $i)
{
	switch( $period )
	{
		case 1:	return $i*15*60;
		case 2:	return $i*3600;
		case 3:	return $i*3600*24;
		case 4:	return $trace_date - strtotime("+1 month", $myTimestamp);
		case 5:	return $trace_date - strtotime("+1 year", $myTimestamp);
	}
	return 0;
}

function ctr_Answer($DATI)
{
	$obj_id     = ctr_obj_number(substr_cut($DATI, 2));
	$period     = hexdec( substr_cut($DATI, 1));
	$data_start = substr_cut($DATI, 4);
	$elementi   = hexdec( substr_cut($DATI, 1));
	$ofg        = DEFAULT_GAS_HOUR;

	$answer[] = (string)$period. " - ". get_period_text_trace()[($period < 6)? $period: 6];
	$answer[] = ctr_date($data_start,4). " - Data_start";
	$answer[] = "$elementi - Elementi";

	$data_year  = hexdec( substr_cut($data_start, 1)) + 2000;
	$data_month = hexdec( substr_cut($data_start, 1));
	$data_day   = hexdec( substr_cut($data_start, 1));
	$data_hour  = hexdec( substr_cut($data_start, 1));

	switch( period )
	{
		case 1:
			$data_hour = $data_hour * 15;
			break;
		case 2:
			break;
		case 3:
			$data_hour = 0;
			break;
		case 4:
			$data_hour = 0;
			$data_day = 0;
			break;
		case 5:
			$data_hour = 0;
			$data_day = 0;
			$data_month = 0;
			break;
	}
	
	// Trace_dati
	$answer[] = "Trace data for :";
	$answer[] = ctr_obj_name($obj_id);
	$trace_date = mktime($data_hour, 0, 0, $data_month, $data_day, $data_year) + $ofg*3600;
	for($i=0; $i<$elementi; $i++)
	{
		$line = ctr_val($DATI, $obj_id, 0x03);
		$info = !ctr_qlf_valid($line[1][0])? "": " (". $line[1][3] .")";
		$answer[] = date('Y-m-d H:i -> ', $trace_date + ctr_get_period_shift_trace($trace_date, $period, $i)). $line[0][0]. $info;
	}
	$answer[] = $DATI;
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
