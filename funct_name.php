<?php
$funct_code = 
	array(
			array(0x2B, '+', 'Application ACK',         'M'),
			array(0x2D, '-', 'Application NACK',        'M'),
			array(0x28, '(', 'Identification',          'M/O'),
			array(0x29, ')', 'Identification (reply)',  'M/O'),
			array(0x3F, '?', 'Query',                   'M/O'),
			array(0x21, '!', 'Answer',                  'M/O'),
			array(0x3B, ';', 'Voluntary (Spontaneous)', 'O'),
			array(0x26, '&', 'Execute Function',        'M'),
			array(0x2F, '/', 'Write Function',          'M'),
			array(0x25, '%', 'End of Session',          'M/O'),
			array(0x23, '#', 'Secret',                  'M'),
			array(0x24, '$', 'Download',                'M'),
			array(0x18, ' ', 'Elgas tunel',             'O'),
			array(0x38, '8', 'Elgas tunel old',         'O'),
	);