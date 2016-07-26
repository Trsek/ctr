<?php
define (CTR_NOT_USE,		0x00);	  // Nepouziva sa
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
define (CTR_ELGAS,			0x18);	  // Tunel pro Elgas
define (CTR_ELGAS_OLD,		0x38);	  // Tunel pro Elgas old

$funct_code = 
	array(
			array(CTR_ACK,          '+', 'Application ACK',         'M'),
			array(CTR_NACK,         '-', 'Application NACK',        'M'),
			array(CTR_IDENTIF,      '(', 'Identification',          'M/O'),
			array(CTR_IDENTIF_ANSW, ')', 'Identification (reply)',  'M/O'),
			array(CTR_QUERY,        '?', 'Query',                   'M/O'),
			array(CTR_ANSWER,       '!', 'Answer',                  'M/O'),
			array(CTR_VOLUNTARY,    ';', 'Voluntary (Spontaneous)', 'O'),
			array(CTR_EXECUTE,      '&', 'Execute Function',        'M'),
			array(CTR_WRITE,        '/', 'Write Function',          'M'),
			array(CTR_END,          '%', 'End of Session',          'M/O'),
			array(CTR_SECRET,       '#', 'Secret',                  'M'),
			array(CTR_DOWNLOAD,     '$', 'Download',                'M'),
			array(CTR_ELGAS,        ' ', 'Elgas tunel',             'O'),
			array(CTR_ELGAS_OLD,    '8', 'Elgas tunel old',         'O'),
	);