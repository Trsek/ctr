<?php
require_once("funct_name.php");
require_once("struct_name.php");
require_once("objects.php");

define (CTR_STR_IDENTIF,		0x30);	  // TABLE-IDENTIFICATION structure
define (CTR_STR_IDENTIF2,	    0x31);	  // TABLE-IDENTIFICATION2 structure
define (CTR_STR_DE0,			0x32);	  // Structure type TABLE-DE0
define (CTR_STR_DEC,			0x33);	  // Structure type TABLE-DEC
define (CTR_STR_DECF,		    0x34);	  // Structure type TABLE-DECF
define (CTR_STR_TECNO,		    0x33);	  // Structure type TABLE-TECNOSYSTEM
define (CTR_STR_REGISTER,	    0x50);	  // REGISTER
define (CTR_STR_ARRAY,		    0x51);	  // Structure type ARRAY
define (CTR_STR_TRACE,		    0x52);	  // Structure type TRACE
define (CTR_STR_TRACE_C,		0x53);	  // Structure type TRACE_C
define (CTR_STR_OPTIONAL,	    0x54);	  // OPTIONAL type structure
define (CTR_STR_SCHEMA,		    0x55);	  // SCHEMA type structure
define (CTR_STR_EVENT,		    0x56);	  // Array_Eventi type structure
define (CTR_STR_ELGAS,		    0xF0);	  // Tunel pro Elgas
define (CTR_STR_TRIGGER_EVENT,  0xF1);	  // Array_Eventi Trigger type structure

$sms_funct = 0;
$sms_struct = 0;


function ctr_array_show($value)
{
	if( !is_array($value))
	{
		$space = "";
		while($value[0] == ' ')
		{
			$space .= "&nbsp;";
			$value = substr($value, 1, strlen($value));
		}
		return $space. $value;
	}

	$out = "";
	foreach ($value as $value_line)
	{
		$out .= ctr_array_show($value_line) . "<br>";
	}
//	$out .= "<hr>";
	return $out;
}

function ctr_show($SMS)
{
	$sms_funct = 0;
	$sms_struct = 0;
	$SMS_FRAME = ctr_analyze_frame($SMS);

	$out  = "<table class='table-style-two'>";
	foreach ($SMS_FRAME as $name => $value)
	{
		$out .= "<tr>";
		$out .= "<td>". $name ."</td>";
		$out .= "<td>";
		$out .= ctr_array_show($value);
		$out .= "</td>";
		$out .= "</tr>";
	}
	$out .= "</table>";
	
	return $out;
}

// analyze profi byte
function ctr_profi($profi)
{
	$profile_text = 
		array('A - metrolog',	 // 0
              'A - maintenance', // 1
              'B - user1',       // 2
              'C - user2',       // 3
              'D - user3',       // 4
              '',            // 5
		      '',            // 6
              'secret');     // 7

	$answer[] = dechex($profi) ."h";
	
	if( $profi & 0x80)
		$answer[] = 'long frame';
	
	$answer[] = (string)(($profi >> 3) & 0x0F) . " - operator (0-admin)";
	$answer[] = (string)($profi & 0x07) . " - profile (" .$profile_text[$profi & 0x07] .")";
	return $answer;
}

// analyze funct byte
function ctr_funct($funct)
{
	global $funct_code;
	$encrypt_text = 
		array('00 - not encrypted',
		      '01 - encrypted use KEYC',
		      '10 - encrypted use KEYT - temporary',		
	          '11 - encrypted use KEYF - factory');
		
	$answer[] = dechex($funct) ."h";
	foreach ($funct_code as $funct_line)
	{
		if( $funct_line[0] == ($funct & 0x3F))
		{
			$answer[] = dechex($funct_line[0]). "h - " .$funct_line[2];
			$answer_done = true;
			break;
		}
	}
	if( !isset($answer_done))
		$answer[] = "unknown";
	$answer[] = $encrypt_text[ $funct >> 6 ];
	return $answer;
}

// analyze struct byte
function ctr_struct($struct)
{
	global $struct_code;
	foreach ($struct_code as $struct_line)
	{
		if( $struct_line[0] == $struct)
		{
			$answer[] = dechex($struct_line[0]). "h - " .$struct_line[1];
			return $answer;
		}
	}
	$answer[] = "unknown";
	return $answer;
}

// metaanalyze frame name
function ctr_analyze_frame(&$SMS)
{
	global $sms_funct;
	global $sms_struct;
	
	$SMS_DATI['ADD']   = substr_cut($SMS, 2);
	$SMS_DATI['PROFI'] = substr_cut($SMS, 1);
	$SMS_DATI['FUNCT'] = substr_cut($SMS, 1);
	$SMS_DATI['STRUCT']= substr_cut($SMS, 1);
	$SMS_DATI['CHAN']  = substr_cut($SMS, 1) ."h";
	$SMS_DATI['DATI']  = substr_cut($SMS, 128);
	$SMS_DATI['CPA']   = substr_cut($SMS, 4);
	$SMS_DATI['CRC']   = substr_cut($SMS, 2);

	$sms_funct = hexdec( $SMS_DATI['FUNCT']) & 0x3F;
	$sms_struct = hexdec( $SMS_DATI['STRUCT']);
	
	$SMS_DATI['PROFI'] = ctr_profi( hexdec( $SMS_DATI['PROFI']));
	$SMS_DATI['FUNCT'] = ctr_funct( hexdec( $SMS_DATI['FUNCT']));
	$SMS_DATI['STRUCT'] = ctr_struct( hexdec( $SMS_DATI['STRUCT']));
	$SMS_DATI['DATI']   = ctr_dati( $SMS_DATI['DATI'], $sms_funct, $sms_struct);
	
	return $SMS_DATI;
}

// analyze data part
function ctr_dati($DATI, $sms_funct, $sms_struct)
{
	$answer = $DATI;
	switch( $sms_struct )
	{
		case CTR_STR_REGISTER:
			require_once 'struct/50-register.php';		// TODO - najdi
			// Query
			if( $sms_funct == CTR_QUERY )
				$answer = ctr_Query($DATI);
			// Answer
			if( $sms_funct == CTR_ANSWER )
				$answer = ctr_Answer($DATI);
			break;
			
		case CTR_STR_TRACE_C:
			require_once 'struct/53-trace_c.php';
			// Query
			if( $sms_funct == CTR_QUERY )
				$answer = ctr_Query($DATI);
			// Answer
			if( $sms_funct == CTR_ANSWER )
				$answer = ctr_Answer($DATI);
			break;
	}

	return $answer;
}
