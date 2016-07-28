<?php
define (CTR_STR_TABLE_STRUCT,   0x01);	  // TABLE structure
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

$struct_code = 
	array(
			0x00 => array('None',                    'O'),
			0x01 => array('TABLE structure',         'M'),
			0x10 => array('TABLE structure reserved','M'),
			0x30 => array('Identification',          'M'),
			0x31 => array('Identification2',         'M'),
			0x32 => array('TABLE-DE0',               'M'),
			0x33 => array('TABLE-DEC',               'M'),
			0x34 => array('TABLE-DECF',              'M'),
			0x35 => array('Reserved for TABLEs',     'O'),
			0x50 => array('REGISTER',                'M'),
			0x51 => array('ARRAY',                   'M'),
			0x52 => array('TRACE',                   'M'),
			0x53 => array('TRACE_C',                 'M'),
			0x54 => array('Optional',                'M'),
			0x55 => array('Schema',                  'O'),
			0x56 => array('Array_Eventi',            'O'),
			0xF0 => array('Tunel Elgas',             'O'),
			0xF1 => array('Array_Eventi_triggers',   'O'),
	);
	
/********************************************************************
* @brief Analyze struct byte
*/
function ctr_struct_name($struct)
{
	global $struct_code;
	return strtoupper(dechex($struct)). "h - " .$struct_code[$struct][0];
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */
