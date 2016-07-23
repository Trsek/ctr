<?php
require("funct_name.php");
require("struct_name.php");

$sms_funct = 0;
$sms_struct = 0;

function ctr_show($SMS)
{
	$sms_funct = 0;
	$sms_struct = 0;
	$SMS_FRAME = ctr_analyze_frame($SMS);

	$out  = "<table>";
	foreach ($SMS_FRAME as $name => $value)
	{
		$out .= "<tr>";
		$out .= "<td>". $name ."</td>";
		$out .= "<td>";
		if( !is_array($value))
			$out .= $value;
		else {
			foreach ($value as $value_line) 
			{
				$out .= $value_line . "<br>";
			}
		}
		$out .= "</td>";
		$out .= "</tr>";
	}
	$out .= "</table>";
	
	return $out;
}


// odsekne 'len' hex znakov zo zaciatku retazca
function substr_cut(&$SMS, $len)
{
	$cut_str = substr($SMS, 0, 2*$len);
	$SMS = substr($SMS, 2*$len, strlen($SMS) - 2*$len);
	return $cut_str;
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

	$answer[] = dechex($profi);
	
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
		
	$answer[] = dechex($funct);
	foreach ($funct_code as $funct_line)
	{
		if( $funct_line[0] == ($funct & 0x3F))
		{
			$answer[] = dechex($funct_line[0]). " - " .$funct_line[2];
			$answer_done = true;
			break;
		}
	}
	if( !isset($answer_done))
		$answer[] = "unknonw";
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
			$answer[] = dechex($struct_line[0]). " - " .$struct_line[1];
			return $answer;
		}
	}
	$answer[] = "unknonw";
	return $answer;
}

// analyze data part
function ctr_dati($DATI, $sms_funct, $sms_struct)
{
	$answer = $DATI;
	if($sms_funct == 0x21 )		// Answer
	{
		
	}
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
	$SMS_DATI['CHAN']  = substr_cut($SMS, 1);
	$SMS_DATI['DATI']  = substr_cut($SMS, 128);
	$SMS_DATI['CPA']   = substr_cut($SMS, 4);
	$SMS_DATI['CRC']   = substr_cut($SMS, 2);

	$sms_funct = hexdec( $SMS_DATI['FUNCT']);
	$sms_struct = hexdec( $SMS_DATI['STRUCT']);
	
	$SMS_DATI['PROFI'] = ctr_profi( hexdec( $SMS_DATI['PROFI']));
	$SMS_DATI['FUNCT'] = ctr_funct( hexdec( $SMS_DATI['FUNCT']));
	$SMS_DATI['STRUCT'] = ctr_struct( hexdec( $SMS_DATI['STRUCT']));
	$SMS_DATI['DATI']   = ctr_dati( $SMS_DATI['DATI'], $sms_funct, $sms_struct);
	
	return $SMS_DATI;
}