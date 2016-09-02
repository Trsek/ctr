<?php
require_once("obj/objects.php");

function get_period_text()
{
	$period_text = 
		array('period incorrect',
			  'period giorno (day) Y,m,d, all 1h traces on the specified day',
		      'period giorno-14 (day-14) Y,m,d, the 1-day traces for the last 15 days (that specified included)',
		      'period mese-11 (month-11) Y,m,0, the 1-month traces for the last 12 months (that specified included)',		
	          'period other');

	return $period_text;
}
	
function ctr_Query(&$DATI)
{
	$password = hex2bin( substr_cut($DATI, 6));
	$obj_id   = ctr_obj_number(substr_cut($DATI, 2));
	$period   = hexdec( substr_cut($DATI, 1));
	$data_rif = substr_cut($DATI, 3);
	$period_text = get_period_text();

	$answer[] = "$password - Access level password";
	$answer[] = ctr_obj_name($obj_id);
	$answer[] = (string)$period. " - ". $period_text[($period < 4)? $period: 4];
	$answer[] = ctr_date($data_rif,3). " - Data_rif";
	$answer[] = "";
	return $answer;
}

/********************************************************************
 * @brief Shift date/time acording period
 */
function ctr_get_period_shift($trace_date, $period, $i)
{
	switch( $period )
	{
		case 1:	return $i*3600;
		case 2:	return $i*3600*24;
		case 3:
			    $str_diff = sprintf("+%d month", $i);
				return strtotime($str_diff, $trace_date) - $trace_date;
	}
	return 0;
}

/********************************************************************
 * @brief Right border of date
 */
function ctr_get_date_format($period)
{
	switch( $period )
	{
		case 1:
			return 'H:i -> ';
		case 2:
			return ' Y-m-d H:i -> ';
			break;
		case 0x80:
		case 0x82:
			return 'H:i -> ';
		case 0x81:
		case 0x83:
			return 'H:i -> ';
		case 3:
		default:
			return ' Y-m-d H:i -> ';
	}
}

function ctr_Answer(&$DATI)
{
	$tot_obj_id_array =
	    array( 
		array(0, array(
				   ''      => '2.1.3',
				)),
		array(1, array(
					'1.0.2' => '2.0.3',
					'1.2.2' => '2.1.3',
					'4.0.2' => '2.3.3',
					'7.0.2' => 'F1.A.3',
					''      => '2.1.3',
				)),
		array(2, array(
					'1.1.3' => '2.0.0',
					'1.3.3' => '2.1.0',
					'2.0.3' => '2.0.0',
					'2.1.3' => '2.1.0',
					'2.3.3' => '2.3.0',
					'1.A.3' => '2.1.0',
					'12.6.3'=> '2.1.0',
					''      => '2.1.0',
				)),
		array(3, array(
					'1.1.4' => '2.0.0',
					'1.3.4' => '2.1.0',
					'1.A.4' => '2.1.0',
					''      => '2.1.0',
				)),
		);						

	$pdr      = substr_cut($DATI, 7);
	$oras     = substr_cut($DATI, 5);
	$ofg      = substr_cut($DATI, 1);
	$diagnrs  = substr_cut($DATI, 2);
	$nem      = hexdec( substr_cut($DATI, 2));
	$period   = hexdec( substr_cut($DATI, 1));
	$obj_id   = ctr_obj_number(substr_cut($DATI, 2));
	$data_rif = substr_cut($DATI, 3);
	$period_text = get_period_text();
	
	$answer[] = $pdr ." - PDR (metering point identification code)";
	$answer[] = ctr_date($oras,5). " - Data&OraS";
	$answer[] = $ofg ."h - OFG (End of day time)";
	$answer[] = $diagnrs ."h - DiagnRS (Reduced historic diagnostics for the day 'g' indicated in Data_rif)";
	if( hexdec($diagnrs) != 0 ) {
		$answer[] = ctr_val($diagnrs, "12.1.0", 0x02);
		unset($answer[count($answer)-1][0][0]);
	}
	$answer[] = $nem ." - NEM (Progresive number last event in queue)";
	$answer[] = (string)$period. " - ". $period_text[($period < 4)? $period: 4];
	$answer[] = ctr_date($data_rif,3). " - Data_rif";

	$data_year  = hexdec( substr_cut($data_rif, 1)) + 2000;
	$data_month = hexdec( substr_cut($data_rif, 1));
	$data_day   = ($period==3)? 1: hexdec( substr_cut($data_rif, 1));
	$trace_date = mktime($ofg, 0, 0, $data_month, $data_day, $data_year);

	// move back
	switch( $period )
	{
		case 1:
			//$trace_date = strtotime("-1 hour", $trace_date);
			$count = 24;
			break;
		case 2:
			$trace_date = strtotime("-14 day", $trace_date);
			$count = 15;
			break;
		case 0x80:
		case 0x82:
			//$trace_date = strtotime("-1 hour", $trace_date);
			$count = 12;
			$period = 1;
			break;
		case 0x81:
		case 0x83:
			$trace_date = strtotime("+12 hour", $trace_date);
			$count = 12;
			$period = 1;
			break;
		case 3:
			$trace_date = strtotime("-11 month", $trace_date);
			$count = 12;
			break;
		default:
			$count = 24;
			break;
	}
	
	// Tot_obj
	$tot_obj_id = $tot_obj_id_array[$period][1];
	$tot_id = ($tot_obj_id[$obj_id]==null)? $tot_obj_id['']: $tot_obj_id[$obj_id];

	$answer[] = "";
	$answer[] = ctr_obj_name($tot_id);		
	$answer[] = ctr_val($DATI, $tot_id, 0x03);

	// Trace_dati
	$answer[] = "TraceC data for :";
	$answer[] = ctr_obj_name($obj_id);
	
	for($i=0; $i<$count && strlen($DATI)>0; $i++)
	{
		$line = ctr_val($DATI, $obj_id, 0x03);
		$info = ctr_qlf_valid($line[1])? "": " (". trim($line[1]) .")";
		$answer[] = date('Y-m-d H:i-', $trace_date + ctr_get_period_shift($trace_date, $period, $i))
		          . date(ctr_get_date_format($period), $trace_date + ctr_get_period_shift($trace_date, $period, $i+1))
		          . $line[0][0]. $info;
	}
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
