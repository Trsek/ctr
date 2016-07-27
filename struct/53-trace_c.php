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
	
	$answer[] = "$password - Access level password";
	$answer[] = ctr_obj_name($obj_id);
	$answer[] = (string)$period. " - ". get_period_text()[($period < 4)? $period: 4];
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
		case 3:	return $trace_date - strtotime("+1 month", $myTimestamp);
				return $i;
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
	
	$answer[] = $pdr ." - PDR (metering point identification code)";
	$answer[] = ctr_date($oras,5). " - Data&OraS";
	$answer[] = $ofg ." - OFG (End of day time)";
	$answer[] = $diagnrs ." - DiagnRS (Reduced historic diagnostics for the day 'g' indicated in Data_rif)";
	$answer[] = $nem ." - NEM (Progresive number last event in queue)";
	$answer[] = (string)$period. " - ". get_period_text()[($period < 4)? $period: 4];
	$answer[] = ctr_date($data_rif,3). " - Data_rif";

	$oras_year  = hexdec( substr_cut($oras, 1)) + 2000;
	$oras_month = hexdec( substr_cut($oras, 1));
	$oras_day   = hexdec( substr_cut($oras, 1));
	$oras_hour  = hexdec( substr_cut($oras, 1));
	$oras_minute = hexdec( substr_cut($oras, 1));
	
	// Tot_obj
	$tot_obj_id = $tot_obj_id_array[$period][1];
	$tot_id = ($tot_obj_id[$obj_id]==null)? $tot_obj_id['']: $tot_obj_id[$obj_id];

	$answer[] = "";
	$answer[] = ctr_obj_name($tot_id);		
	$answer[] = ctr_val($DATI, $tot_id, 0x03);

	// Trace_dati
	$answer[] = "TraceC data for :";
	$answer[] = ctr_obj_name($obj_id);
	$trace_date = mktime($ofg, 0, 0, $data_month, $data_day, $data_year);
	for($i=0; $i<24; $i++)
	{
		$line = ctr_val($DATI, $obj_id, 0x03);
		$info = ctr_qlf_valid($line[1])? "": " (". trim($line[1]) .")";
		$answer[] = date('Y-m-d H:i -> ', $trace_date + ctr_get_period_shift($trace_date, $period, $i)). $line[0][0]. $info;
	}
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
