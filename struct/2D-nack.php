<?php
require_once("funct/funct_name.php");
define (NACK_TXT, 'struct/NACK_Explanation.txt');

/********************************************************************
* @brief ACK parser
*/
function ctr_ack($DATI)
{
	$ACK_Code = substr_cut($DATI, 1);
	$FUNCT_id = substr_cut($DATI, 1);
	$Add_data = substr_cut($DATI, 24);
	
	$answer[] = $ACK_Code ."h";
	$answer[] = ctr_funct_name(hexdec($FUNCT_id));
	$answer[] = $Add_data ." - Add_data";
	$answer[] = $DATI;
	return $answer;
}

/********************************************************************
* @brief NACK explanation (read file NACK_TXT stored from wiki)
*/
function ctr_NACK_slovak( $TAB_NACK )
{
	$start = false;
	$answer = "";
	
	foreach(file(NACK_TXT) as $ftxt)
	{
		$ftxt = trim($ftxt);
		if( empty($ftxt))
			continue;
		
		if( $ftxt[0] == ';' )
		{
			// already started - finish
			if( $start )
				break;
			
			if( hexdec(substr($ftxt,3,2)) == $TAB_NACK )
				$start = true;
			
			continue;
		}
		
		if( $start )
			$answer[] = $ftxt;
	}
	return $answer;
}

/********************************************************************
* @brief NACK parser
*/
function ctr_nack($DATI)
{
	$nack_text = array(
			0x40 => array('Generic',
						  'Can be used as generic NACK in cases where there are no specific codes'),
			0x41 => array('Access denied',
						  'If the password has not been recognized or if the access has not the authorization'),
			0x42 => array('Function not implemented',
						  'The function has not been implemented in the application'),
			0x43 => array('Response to the Write',
						  'An object or one of its attributes is not supported by the application'),
			0x44 => array('Data structure not implemented',
						  'The data structure is not supported by the application'),
			0x45 => array('Response to the Query (Overflow)',
						  'More data items have been requested than the permitted number'),
			0x46 => array('Incorrect data field',
						  'An error in the data field has been detected for the command received'),
			0x47 => array('Function not allowed',
						  'The requested function is not allowed because privileges are not held'),
			0x48 => array('Function $ - Down Loader',
						  'Downloader cannot be enabled due to inconsistency between parameters'),
			0x49 => array('Non-availability',
						  'The Server process is temporarily busy and cannot execute the command'),
			0x4A => array('Response to the Write',
						  'A write operation was not executed due to a session error'),
			0x4B => array('Response to the Execute Function',
						  'The execute function specified by Obj.id cannot be executed for reasons other than privileges'),
			0x4C => array('Encryption error',
						  'CPA irregularity detected after decryption'),
			0x4D => array('Function  D-Down Loading',
						  'One DL segment not received correctly'),
			0x4E => array('Response to Write',
						  'The Write cannot be accepted because the date of validity has expired'),
			0x4F => array('Response to Execute',
						  'The Execute cannot be accepted because the date of validity has expired'),
			0x50 => array('Response to Write or Execute',
						  'The Write or Execute cannot be executed because the condition is under maintenance'),
			0x51 => array('Response to Write or Execute',
						  'The write or execute cannot be executed because the events buffer is full'),
			0x52 => array('Response to Write or Execute',
						  'The write or execute cannot be executed because there is a seal preventing this'),
	);

	global $funct_code;
	
	$TAB_NACK = hexdec(substr_cut($DATI, 1));
	$FUNCT_id = substr_cut($DATI, 1);
	$Add_data = substr_cut($DATI, 20);
	
	$answer[] = dechex($TAB_NACK) ."h - ". $nack_text[ $TAB_NACK][0];
	$answer[] = $nack_text[$TAB_NACK][1];
	$answer[] = "";
	$answer[] = ctr_funct_name(hexdec($FUNCT_id));
	
	switch( $TAB_NACK )
	{
		case 0x42:
		case 0x43:
		case 0x46:
		case 0x47:
		case 0x4B:
		case 0x4F:
			$answer[] = ctr_obj_name( ctr_obj_number(substr_cut($Add_data, 2)));
			$answer[] = hexdec(substr_cut($Add_data, 1)) ." - WDB";
			$answer[] = hexdec(substr_cut($Add_data, 1)) ." - P_SES";
			break;
		case 0x44:
			$answer[] = ctr_struct_name( hexdec(substr_cut($Add_data, 1)));
			break;
		case 0x48:
			$answer[] = ctr_obj_name( ctr_obj_number(substr_cut($Add_data, 2)));
			$answer[] = substr_cut($Add_data, 4) ." - ID-SFTW";
			$answer[] = substr_cut($Add_data, 5) ." - ID-CIA";
			$answer[] = substr_cut($Add_data, 6) ." - ID-VF";
			break;
		case 0x4A:
		case 0x4E:
			$answer[] = hexdec(substr_cut($Add_data, 1)) ." - WDB";
			$answer[] = hexdec(substr_cut($Add_data, 1)) ." - P_SES";
			break;
		case 0x4D:
			$answer[] = substr_cut($Add_data, 4) ." - Identify";
			$answer[] = substr_cut($Add_data, 2) ." - Segment";
			break;
		case 0x50:
		case 0x51:
		case 0x52:
			$answer[] = hexdec(substr_cut($Add_data, 1)) ." - SD";
			$answer[] = hexdec(substr_cut($Add_data, 1)) ." - WDB";
			$answer[] = ctr_obj_name( ctr_obj_number(substr_cut($Add_data, 2)));
			break;	
	}
	
	$answer[] = $Add_data ." - Add_data";
	$answer[] = $DATI;
	$answer[] = "";
	$answer[] = "Slovak explanation:";
	$answer[] = ctr_NACK_slovak( $TAB_NACK );
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
