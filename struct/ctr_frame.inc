<?php
require_once ("struct/struct_name.php");

define ('CTR_TABLE_OBJ_ID', 0);
define ('CTR_TABLE_ATTW',   1);

$TABLE_FRAME_DEF = array(
				// Identification()
				CTR_STR_IDENTIF => array(
					array(	 "C.0.0",		0x02 ),		// C.0.0 Metering Point Identification Code
					array(	 "9.0.0",		0x02 ),		// 9.0.0 Equipment parameters
					array(	 "C.0.1",		0x02 ),		// C.0.1 Number of channels controlled
					array(	 "9.1.1",		0x02 ),		// 9.1.1 Size and type of event buffer
					array(	 "C.2.0",		0x02 ),		// C.2.0 AN_CONT Meter data
					array(	"10.1.0",		0x02 ),		// 10.1.0 Number of Events
					array(	"10.2.0",		0x02 ),		// 10.2.0 Total alarm - Number of Events
					array(	"10.3.0",		0x02 ),		// 10.3.0 Total trigger events logged
					array(	"12.0.0",		0x02 ),		// 12.0.0 Device status
					array(	 "D.6.3",		0x02 ),		// D.6.3 Pseudo-random value(each character 0-255)
					array(	"17.0.4",		0x02 ),		// 17.0.4 Tariff Scheme ID
					array(	 "9.2.5",		0x02 ),		// 9.2.5 Software identifiers
				// added for Elster
					array(	"FF.0.2",		0x02 ),		// FF.0.2 Space 10x
					array(	 "9.2.0",		0x02 ),		// 9.2.0 DLN - Device Logical Name (ELSxxAnnnnnnnnnn)
				),

				// Identification2()
				CTR_STR_IDENTIF2 => array(
					array(  "C.0.0",		0x02 ),		//  C.0.0 Metering Point Identification Code
					array(  "8.0.0",		0x02 ),		//  8.0.0 Extended date format
					array(  "8.2.0",		0x02 ),		//  8.2.0 Extended date format
					array(  "8.1.2",		0x02 ),		//  8.1.2 Shift.val FFFF if not implemented
					array( "12.1.0",		0x02 ),		// 12.1.0 Diagnostics - Extended format
					array(  "8.1.3",		0x02 ),		//  8.1.3 Gas Day time
					array( "10.1.0",		0x02 ),		// 10.1.0 Number of Events
					array( "12.0.0",		0x02 ),		// 12.0.0 Device status
					array(  "C.0.1",		0x02 ),		//  C.0.1 Number of channels controlled
					array(  "9.1.1",		0x02 ),		//  9.1.1 Event buffer size
					array( "17.0.4",		0x02 ),		// 17.0.4 Tariff Scheme ID
					array(  "9.2.5",		0x02 ),		//  9.2.5 Software identifiers
				),

				// DE0 - (Device data computed)
				CTR_STR_DE0 => array(
					array(  "C.0.0",		0x02 ),		//  C.0.0 Metering Point Identification Code
					array(  "8.0.0",		0x02 ),		//  8.0.0 Extended date format
					array(  "8.1.2",		0x02 ),		//  8.1.2 Shift.val FFFF if not implemented
					array( "12.1.0",		0x02 ),		// 12.1.0 Diagnostics - Extended format
					array( "10.1.0",		0x02 ),		// 10.1.0 Number of Events
					array( "12.0.0",		0x02 ),		// 12.0.0 Device status
					array(  "D.9.0",		0x02 ),		//  D.9.0 Seals status
				),

				// DEC (channels 1-2)-(Data computed by the Channel)
				CTR_STR_DEC => array(
					array(  "C.0.0",		0x02 ),		//  C.0.0 Metering Point Identification Code
					array(  "8.0.1",		0x02 ),		//  8.0.1 Extended date format
					array( "12.2.0",		0x02 ),		// 12.2.0 Reduced diagnostics
					array(  "2.0.0",		0x03 ),		//  2.0.0 Value of the gross volumes totalizer, with qualifier
					array(  "2.1.0",		0x03 ),		//  2.1.0 Value for the corrected volumes totalizer, with qualifier
					array(  "2.3.0",		0x03 ),		//  2.3.0 Value of gross volumes totalizer (alarm), with qualifier
					array(  "1.0.0",		0x03 ),		//  1.0.0 Value for the instantaneous gross flow, with qualifier
					array(  "1.2.0",		0x03 ),		//  1.2.0 Value for the instantaneous corrected flow, with qualifier
					array( "13.0.0",		0x02 ),		// 13.0.0 Digital input status
					array( "13.0.1",		0x02 ),		// 13.0.1 Digital alarm input status
					array(  "4.0.0",		0x03 ),		//  4.0.0 Absolute measurement pressure
					array(  "7.0.0",		0x03 ),		//  7.0.0 Absolute measurement temperature
					array(  "A.0.0",		0x03 ),		//  A.0.0 C Conversion coefficient at standard conditions (C)
					array(  "A.2.0",		0x03 ),		//  A.2.0 Z Coefficient (Zb/Z1)
					array(  "8.1.2",		0x02 ),		//  8.1.2 Shift.val FFFF if not implemented
					array( "10.1.0",		0x02 ),		// 10.1.0 Number of Events
					array( "12.0.0",		0x02 ),		// 12.0.0 Device status
					array(  "D.9.0",		0x02 ),		//  D.9.0 Seals status
					array(  "E.C.0",		0x02 ),		//  E.C.0 GSM/GPRS signal intensity
				// added for CPL
					array(  "C.1.1",		0x02 ),		//  C.1.1 Converter Master Record
				// added for Ireland
					array(  "4.0.3",		0x03 ),		//  4.0.3 Absolute measurement pressure
					array(  "7.0.3",		0x03 ),		//  7.0.3 Absolute measurement temperature
				),

				// DECF (channels 1-24)-(Data computed by the Channel, with Bands)
				CTR_STR_DECF => array(
					array(  "C.0.0",		0x02 ),		//  C.0.0 Metering Point Identification Code
					array(  "8.0.1",		0x02 ),		//  8.0.1 Extended date format
					array( "12.2.0",		0x02 ),		// 12.2.0 Reduced diagnostics
					array( "10.1.0",		0x02 ),		// 10.1.0 Number of Events
					array( "17.0.4",		0x02 ),		// 17.0.4 ID_PT Identifier for the active tariff scheme len PT_ID
					array(  "2.1.0",		0x03 ),		//  2.1.0 Value of the volume totalizer at standard conditions
					array(  "2.3.0",		0x03 ),		//  2.3.0 Value of the gross volumes totalizer (alarm)
					array(  "2.3.7",		0x03 ),		//  2.3.7 Value of the band 1 volume totalizer measured under alarm conditions
					array(  "2.3.8",		0x03 ),		//  2.3.8 Value of the band 2 volume totalizer measured under alarm conditions
					array(  "2.3.9",		0x03 ),		//  2.3.9 Value of the band 3 volume totalizer measured under alarm conditions
					array(  "2.5.0",		0x03 ),		//  2.5.0 Value for the band 1 volume totalizer at standard conditions in the current period
					array(  "2.5.1",		0x03 ),		//  2.5.1 Value for the band 2 volume totalizer at standard conditions in the current period
					array(  "2.5.2",		0x03 ),		//  2.5.2 Value for the band 3 volume totalizer at standard conditions in the current period
					array(  "8.0.2",		0x02 ),		//  8.0.2 Date, time and reason why the billing period closed
					array( "12.6.6",		0x02 ),		// 12.6.6 Reduced historic diagnostics at the end of the period
					array(  "2.1.6",		0x03 ),		//  2.1.6 Volume totalizer under standard conditions recorded at the end of the previous period
					array(  "2.3.6",		0x03 ),		//  2.3.6 Value of the volume totalizer measured under alarm conditions recorded at the end of the previous period
					array(  "2.3.A",		0x03 ),		//  2.3.A Value of the band 1 volume totalizer measured under alarm conditions
					array(  "2.3.B",		0x03 ),		//  2.3.B Value of the band 2 volume totalizer measured under alarm conditions
					array(  "2.3.C",		0x03 ),		//  2.3.C Value of the band 3 volume totalizer measured under alarm conditions
					array(  "2.5.3",		0x03 ),		//  2.5.3 Value for the band 1 volume totalizer at standard conditions in the previous period
					array(  "2.5.4",		0x03 ),		//  2.5.4 Value for the band 2 volume totalizer at standard conditions in the previous period
					array(  "2.5.5",		0x03 )		//  2.5.5 Value for the band 3 volume totalizer at standard conditions in the previous period
				),
		);

/*----------------------------------------------------------------------------*/
/* END OF FILE */
