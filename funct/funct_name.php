<?php
define (CTR_NOT_USE,		0x00);	  // Not use
define (CTR_ACK,			0x2B);	  // Application ACK (Send/Noreply)
define (CTR_NACK,			0x2D);	  // Application NACK (Send/Noreply)
define (CTR_IDENTIF,		0x28);	  // Identification (Send/Reply)
define (CTR_IDENTIF_ANSW,	0x29);	  // Identification answer (Send/Noreply)
define (CTR_QUERY,			0x3F);	  // Query (Send/Reply)
define (CTR_ANSWER,			0x21);	  // Answer (Send/Noreply)
define (CTR_VOLUNTARY,		0x3B);	  // Spontaneous (Send/Noreply)
define (CTR_EXECUTE,		0x26);	  // Execute function (Send/Confirm)
define (CTR_WRITE,			0x2F);	  // Write function (Send/Confirm)
define (CTR_END,			0x25);	  // End of Session (Send/Noreply)
define (CTR_SECRET,			0x23);	  // Sevret (Send/Confirm)
define (CTR_DOWNLOAD,		0x24);	  // Download (Send/Confirm)
define (CTR_ELGAS,			0x18);	  // Tunel for Elgas
define (CTR_ELGAS_OLD,		0x38);	  // Tunel for Elgas old

define (CTR_FUNCT_ABR,   0);
define (CTR_FUNCT_DESC,  1);
define (CTR_FUNCT_NEED,  2);

$funct_code = 
	array(
			CTR_ACK          => array('+', 'Application ACK',         'M'),
			CTR_NACK         => array('-', 'Application NACK',        'M'),
			CTR_IDENTIF      => array('(', 'Identification',          'M/O'),
			CTR_IDENTIF_ANSW => array(')', 'Identification (reply)',  'M/O'),
			CTR_QUERY        => array('?', 'Query',                   'M/O'),
			CTR_ANSWER       => array('!', 'Answer',                  'M/O'),
			CTR_VOLUNTARY    => array(';', 'Voluntary (Spontaneous)', 'O'),
			CTR_EXECUTE      => array('&', 'Execute Function',        'M'),
			CTR_WRITE        => array('/', 'Write Function',          'M'),
			CTR_END          => array('%', 'End of Session',          'M/O'),
			CTR_SECRET       => array('#', 'Secret',                  'M'),
			CTR_DOWNLOAD     => array('$', 'Download',                'M'),
			CTR_ELGAS        => array(' ', 'Elgas tunel',             'O'),
			CTR_ELGAS_OLD    => array('8', 'Elgas tunel old',         'O'),
	);
	

/********************************************************************
* @brief Human information about Function
* @param $funct_id - identification in dec format
*/
function ctr_funct_name($funct_id)
{
	global $funct_code;
	
	if( $funct_code[$funct_id]==null )
		$answer = dechex($funct_id). "h - unknown";
	else
		$answer = dechex($funct_id). "h - ". $funct_code[$funct_id][CTR_FUNCT_DESC];
		
	return $answer;
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
