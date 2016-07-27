<?php
define (CTR_COMPANION_OBJ_ID, 0);
define (CTR_TYPE,             1);
define (CTR_UNIT,             2);
define (CTR_LEN,              3);
define (CTR_DESCRIPTION,      4);

$CTR_List = array
(
	// nieco neskodne ako default
	"0.0.0"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Default for not found"),
	// Flow as at the measurement conditions
	"1.0.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qm    - instantaneous"),
	"1.0.1"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qm_15 - 15min average"),
	"1.0.2"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qm_1h - 1h average"),
	"1.0.3"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qmc   - standard"),

	// Volume as at the measurement conditions
	"1.1.3"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3,             3, "Vm_g  - 1day"),
	"1.1.4"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3,             3, "Vm_m  - 1month"),
	"1.1.5"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3,             3, "Vm_1y - 1year"),

	// Flow converted to standard conditions
	"1.2.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qb    - instantaneous"),
	"1.2.1"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qb_15 - 15min average"),
	"1.2.2"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qb_h  - 1h average"),
	"1.2.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qbc   - standard"),

	// Volume converted to standard conditions
	"1.3.3"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3,             3, "Vb_g  - 1day"),
	"1.3.4"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3,             3, "Vb_m  - 1month"),
	"1.3.5"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3,             3, "Vb_1y - 1year"),

	// Standard flow as at minimum measurement conditions
	"1.6.1"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_15 - 15min period"),
	"1.6.2"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_1h - 1 hour period"),
	"1.6.3"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_g  - day period"),
	"1.6.4"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_m  - month period"),

	// Standard flow converted to standard conditions (minimum)
	"1.7.1"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_15 - 15min period"),
	"1.7.2"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_1h - 1 hour period"),
	"1.7.3"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_g  - day period"),
	"1.7.4"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_min_m  - month period"),

	// Standard flow as at maximum measurement conditions
	"1.9.1"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_max_15 - 15min period"),
	"1.9.2"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_max_1h - 1 hour period"),
	"1.9.3"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_max_g  - day period"),
	"1.9.4"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_m3h,            3, "Qcm_max_m  - month period"),

	// Standard flow converted to standard conditions (maximum)
	"1.A.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qcb_max_1h - hour period"),
	"1.A.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qcb_max_g  - day period"),
	"1.A.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qcb_max_m  - month period"),
	// pre potreby Trace
	"F1.A.3" => array( "F2.A.4", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Qcb_max_g"),
	"F2.A.4" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3h,            3, "Qcb_max_g"),

	// Contractual hourly flow
	"1.C.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Qcontr - per hour"),
	"1.C.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3,             3, "Qnom_min - minimum per hour"),
	"1.C.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_m3,             3, "Qnom_max - maximum per hour"),

	// Drawable volume
	"1.E.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Vpre_g - in 1 day"),
	"1.E.4"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Vpre_m - in 1 month"),
	"1.E.5"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Vpre_y - in 1 year"),

	// Volumes in error
	"1.F.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Ve_g - in 1 day"),
	"1.F.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Ve_m - in 1 month"),
	"1.F.4"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             3, "Ve_y - in 1 year"),

	// Totalizer for Volumes as at the measurement conditions
	"2.0.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm  - current"),
	"2.0.1"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_15 - 15min"),
	"2.0.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_h  - 1hour"),
	"2.0.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_g  - 1day"),
	"2.0.4"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_m  - 1month"),
	"2.0.5"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_y  - 1year"),
	"2.0.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_pf - billing period"),

	// Totalizer for Converted Volumes at base conditions
	"2.1.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb  - current"),
	"2.1.1"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_15 - 15min"),
	"2.1.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_h  - 1hour"),
	"2.1.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_g  - 1day"),
	"2.1.4"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_m  - 1month"),
	"2.1.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_pf - billing period"),

	// Totalizer for Volumes measured in alarm conditions
	"2.3.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme - current"),
	"2.3.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_h"),
	"2.3.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_g"),
	"2.3.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_pf"),
	"2.3.7"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_f1"),
	"2.3.8"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_f2"),
	"2.3.9"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_f3"),
	"2.3.A"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_pf_f1"),
	"2.3.B"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_pf_f2"),
	"2.3.C"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_pf_f3"),

	// Totalizer for Converted Volumes at standard conditions during alarm conditions
	"2.4.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe - current"),
	"2.4.1"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_15 - 15min"),
	"2.4.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_h  - 1hour"),
	"2.4.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_g  - 1day"),
	"2.4.4"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_m  - 1month"),
	"2.4.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_pf - billing period"),

	"2.5.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vbf1"),
	"2.5.1"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vbf2"),
	"2.5.2"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vbf3"),

	"2.5.3"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vbf1 - previous"),
	"2.5.4"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vbf2 - previous"),
	"2.5.5"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vbf3 - previous"),

	// tychto 6 nevyzaduje norma (JT)
	"2.5.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vf1"),
	"2.5.7"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vf2"),
	"2.5.8"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vf3"),

	"2.5.9"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vf1"),
	"2.5.A"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vf2"),
	"2.5.B"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Vf3"),

	// Metering pressure
	"4.0.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P - instantaneous"),
	"4.0.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P_15 - 15 min"),
	"4.0.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P_h - 1h"),
	"4.0.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P_g - over day"),
	"4.0.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P_m - over month"),
	"4.0.5"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P_y - over year"),

	// Attributed barometric pressure
	"4.2.6"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "P - barometric pressure"),
	"4.9.0"  => array( "F4.9.2", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pb - barometric pressure"),
	"F4.9.2" => array( "F4.9.3", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Ppcs - 1,01325"),
	"F4.9.3" => array( "F4.9.4", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pp - 1,01325"),
	"F4.9.4" => array( "F4.9.5", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pris - 1,01325"),
	"F4.9.5" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Ppre - 1,01325"),
	// Reference pressure for converting volumes to standard thermodynamic conditions
	"4.9.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pb - barometric pressure"),
	"4.9.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Ppcs - 1,01325"),
	// Reference pressure for the density calculation
	"4.9.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pp - 1,01325"),
	// Backup metering pressure
	"4.9.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pris - 1,01325 (Replacement value for the calculation of when the sensor is faulty or exceeded limit of the measuring range)"),
	// Present pressure
	"4.9.5"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Ppre - 1,01325 (Using for calculating constant temperature)"),
	// Nominal input pressure
	"4.A.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pnom_in"),
	// Nominal measurement pressure
	"4.A.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Pnom"),

	// Metering temperature
	"7.0.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "T - instantaneous"),
	"7.0.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "T_15 - 15 min"),
	"7.0.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "T_h - 1h"),
	"7.0.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "T_g - day"),
	"7.0.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "T_m - month"),
	"7.0.5"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "T_y - year"),
	// day degrees period - when day degrees must be calculated
	"7.9.0"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_Kelvin,         3, "T_y - year"),

	// Reference temperatures - All
	"7.B.0"  => array( "F7.B.2", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tb - Reference temperature for volume conversion"),
	"F7.B.2" => array( "F7.B.3", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tpcs"),
	"F7.B.3" => array( "F7.B.4", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tcb"),
	"F7.B.4" => array( "F7.B.5", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tp"),
	"F7.B.5" => array( "F7.B.6", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tris - Backup metering temperature"),
	"F7.B.6" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tpre - Preset temperature"),
	// Preset temperature
	"7.B.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tb - Reference temperature for volume conversion"),
	"7.B.5"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tris - Backup metering temperature (Replacement value for the calculation of when the sensor is faulty or exceeded limit of the measuring range)"),
	"7.B.6"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Tpre - Preset temperature (Using for calculating constant temperature)"),
	// Ambient operating temperature
	"7.C.0"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_Kelvin,         6, "Tamb_fun, temperature sensor range -25C-60C (248.15K-333K.15)"),

	// Extended date format
	"8.0.0"  => array(  "0.0.0", VAL_TYPE_DATETIME,     UNIT_DEFAULT,        9, "Date, time format"),
	"8.0.1"  => array(  "0.0.0", VAL_TYPE_DATETIME,     UNIT_DEFAULT,        5, "Date, time light"),
	"8.0.2"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        6, "Date of Closure of the Billing Period"),
	// second alignment
	"8.1.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        2, "Adjust +/- second"),
	// gas day time
	"8.1.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "OFG - start of the gas day"),
	// gas day time related with UTC
	"8.1.F"  => array( "F8.1.F", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "OFG - start of the gas day"),
	"F8.1.F" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "UTC - plynarenska hodina podla local/UTC"),
		// gas year
	"8.1.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        7, "Standart gas day from->to"),
	"8.2.0"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        5, "Daylight saving time - kedy sa prepina letny/zimny cas"),
	// significant Dates
	"8.3.1"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last reset date/time"),
	"8.3.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last reset of event queue"),
	"8.3.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last status change"),
	"8.3.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last change of password"),
	"8.3.5"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last deactivation of seals"),
	"8.3.6"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last firmware update"),
	"8.3.7"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Last total configuration"),

	// Equipment parameters
	"9.0.0"  => array( "F9.0.1", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        0, "All parameters"),
	"F9.0.1" => array( "F9.0.2", VAL_TYPE_STRING16,     UNIT_DEFAULT,       12, "CCODE - Equipment manufacturer code"),
	"F9.0.2" => array( "F9.0.3", VAL_TYPE_STRING8,      UNIT_DEFAULT,        5, "CIA - Equipment identification code"),
	"F9.0.3" => array( "F9.0.4", VAL_TYPE_STRING8,      UNIT_DEFAULT,        4, "CCA - Equipment configuration code"),
	"F9.0.4" => array( "F9.0.5", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Firmware version"),
	"F9.0.5" => array( "F9.0.7", VAL_TYPE_STRING3,      UNIT_DEFAULT,        3, "Equipment class"),
	"F9.0.7" => array( "F9.0.9", VAL_TYPE_STRING8,      UNIT_DEFAULT,        4, "Protocol version"),
	"F9.0.9" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Type of synchronization supported"),

	"9.0.1"  => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       12, "CCODE - Equipment manufacturer code"),
	"9.0.2"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        5, "CIA - Equipment identification code"),
	"9.0.3"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        4, "CCA - Equipment configuration code"),
	"9.0.4"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Firmware version"),
	"9.0.5"  => array(  "0.0.0", VAL_TYPE_STRING3,      UNIT_DEFAULT,        3, "Equipment class"),
	"9.0.7"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        4, "Protocol version"),
	"9.0.9"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Type of synchronization supported"),
	"9.1.1"  => array( "F9.1.1", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Event buffer size"),
	"F9.1.1" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Event buffer size"),
	"9.1.2"  => array(  "0.0.0", VAL_TYPE_STRING3,      UNIT_DEFAULT,        3, "Alarm buffer size"),
	"9.1.3"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Trigger buffer size"),
	"9.2.0"  => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       16, "Equipment Series Number"),
	"9.2.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Number of Channels supported"),
	"9.2.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        2, "Total optional objects supported"),
	"9.2.5"  => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       11, "Software identifiers which is active - CRC, date activated"),

	"9.3.0"  => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       10, "Metering Firmware version"),
	"9.4.0"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Address of the device"),
	"9.5.0"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       11, "Download parameters, nepotrebujem spc. fciu lebo budem ident aj segment ukladat nativne"),
	"9.5.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "NCIC"),

	// Volume converter
	"A.0.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C - Conversion coefficient at standard conditions (C)"),
	"A.0.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C_15 - 15 min average"),
	"A.0.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C_1h - 1h average"),
	"A.0.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C_g  - 1 day average"),
	"A.0.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C_m  - 1 month average"),
	"A.0.5"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C_y  - 1 year average"),

	// Compressibility as at measurement conditions
	"A.1.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z1 - Coefficient"),
	"A.1.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z1 - Coefficient"),
	"A.1.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z1 - Coefficient"),
	"A.1.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z1 - Coefficient"),
	"A.1.6"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z_i - Coefficient (nahradni K)"),
	"A.1.7"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Zb - Coefficient"),

	"A.2.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z - Coefficient (Zb/Z1)"),
	"A.2.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z - 1h average"),
	"A.2.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z - 1d average"),
	"A.2.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Z - 1m average"),

	"A.3.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_kgm3,           3, "pbgas - Gas density measured"),
	"A.3.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_kgm3,           3, "pbgas_i - Gas density attributed"),
	"A.3.7"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_kgm3,           3, "pbgas_r - Gas density backup"),
	"A.4.0"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_kgm3,           3, "pbaer - Air density measured"),
	"A.4.6"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_kgm3,           3, "pbaer_i - Air density attributed"),
	"A.4.7"  => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_kgm3,           3, "pbaer_r - Air density backup"),
	"A.5.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Dgas - Density relative to air-measured"),
	"A.5.6"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Dgas_i - Density relative to air-attributed"),
	"A.6.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "N2 - Nitrogen N2 percentage-measurement"),
	"A.7.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CO2 - Carbon dioxide CO2 percentage-measurement"),
	"A.8.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "H2 - Hydrogen H2 concentration-measurement"),
	"A.9.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CO - Carbon Monoxide CO concentration-measured"),

	// Methods supported for calculating Z - musi byt pred parametrami A.0.0 kvoli set to default
	"A.B.1"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Z - Methods supported for calculating Z"),
	"A.B.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Z - Active method for computation Z AGANX19, AGA8"),
	"A.B.3"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Methods supported for calculating converted flows and volumes AGA3, AGA7, AGA9"),
	"A.B.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Active method for calculating converted flows and volumes AGA3, AGA7, AGA9"),

	"A.C.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "H2_i - Hydrogen H2 percentage-attributed"),
	"A.C.1"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CO_i - CO percentage-attributed"),
	"A.C.2"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CH4_i - CH4 concentration-attributed"),
	"A.C.3"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "N2_i - N2 concentration-attributed"),
	"A.C.4"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CO2_i - CO2 concentration-attributed"),
	"A.C.8"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_MJm3,           3, "HCV attributed"),

	// Parametri per calcolo Z estesa - PZE_i Calculation paramters attributed CO_i, H2_i, CH4_i, N_i, CO2_i, pbaer_i, pbgas_i, PCS_i
	"A.C.A"  => array( "FA.B.1", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CO% measured"),
	"FA.B.1" => array( "FA.B.2", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "H2% measured"),
	"FA.B.2" => array( "FA.B.3", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C1H4"),
	"FA.B.3" => array( "FA.B.4", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C2H6"),
	"FA.B.4" => array( "FA.B.5", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C3H8"),
	"FA.B.5" => array( "FA.B.6", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "H2O"),
	"FA.B.6" => array( "FA.B.7", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "H2S"),
	"FA.B.7" => array( "FA.B.8", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "O2"),
	"FA.B.8" => array( "FA.B.9", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "iC4H10"),
	"FA.B.9" => array( "FA.C.1", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "nC4H10"),
	"FA.C.1" => array( "FA.C.2", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "iC5H12"),
	"FA.C.2" => array( "FA.C.3", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "nC5H12"),
	"FA.C.3" => array( "FA.C.4", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C6H14"),
	"FA.C.4" => array( "FA.C.5", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C7H16"),
	"FA.C.5" => array( "FA.C.6", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C8H18"),
	"FA.C.6" => array( "FA.C.7", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C9H20"),
	"FA.C.7" => array( "FA.C.8", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "C10H22"),
	"FA.C.8" => array( "FA.C.9", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "He"),
	"FA.C.9" => array( "FA.C.B", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "CO2% measured"),
	"FA.C.B" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_DEFAULT,        3, "Ar"),
	"B.1.0"  => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_MJm3,           3, "HCV current"),

	// Metering point identification code
	"C.0.0"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        7, "Metering point identification code"),
	"C.0.1"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Numbers of channels controlled"),
	"C.0.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "System type 00hex - 23hex"),
	"C.0.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Type of metering system - Data logger integrated with the converter"),
	"C.0.4"  => array(  "0.0.0", VAL_TYPE_STRING,       UNIT_DEFAULT,       60, "System location"),
	"C.0.5"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        9, "System georeferencing"),
	"C.0.6"  => array(  "0.0.0", VAL_TYPE_STRING32,     UNIT_DEFAULT,       30, "Region name"),
	"C.0.7"  => array(  "0.0.0", VAL_TYPE_STRING32,     UNIT_DEFAULT,       30, "End customer identification code"),
	"C.1.1"  => array( "FC.1.1", VAL_TYPE_STRING16,     UNIT_DEFAULT,       20, "Pressure transducer serial"),
	"FC.1.1" => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       16, "Pressure transducer serial"),
	"C.1.2"  => array( "FC.1.2", VAL_TYPE_STRING16,     UNIT_DEFAULT,       20, "Temperature transducer serial"),
	"FC.1.2" => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       16, "Pressure transducer serial"),
	"C.2.0"  => array( "F0.2.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,       4, "AN_CONT - Meter Master Record - Type"),
	"F0.2.0" => array( "F0.2.1", VAL_TYPE_FLOAT,        UNIT_m3,            3, "AN_CONT - Qnom_max - Maximum flow for the meter"),
	"F0.2.1" => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       13, "AN_CONT - serial no."),
	"C.2.1"  => array( "FC.2.1", VAL_TYPE_STRING8,      UNIT_DEFAULT,       4, "Converter Master Record"),
	"FC.2.1" => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       16, "Serial number"),
	// for TecnoSystem
	"8F.6.0" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "CAUSALE - A code used to identify the type of operation"),
	"97.0.0" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        4, "DISCO - Identifier of Distribution company (end user)"),
	"8C.3.0" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       12, "CP - Identifers used in Tecnosystem Database"),

	// Security Profile 0
	"D.0.1"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 administrator password"),
	"D.0.2"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user1 password"),
	"D.0.3"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user2 password"),
	"D.0.4"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user3 password"),
	"D.0.5"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user4 password"),
	"D.0.6"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user5 password"),
	"D.0.7"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user6 password"),
	"D.0.8"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user7 password"),
	"D.0.9"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user8 password"),
	"D.0.A"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 0 user9 password"),

	// Security Profile 1
	"D.1.1"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 administrator password"),
	"D.1.2"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user1 password"),
	"D.1.3"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user2 password"),
	"D.1.4"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user3 password"),
	"D.1.5"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user4 password"),
	"D.1.6"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user5 password"),
	"D.1.7"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user6 password"),
	"D.1.8"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user7 password"),
	"D.1.9"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user8 password"),
	"D.1.A"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 1 user9 password"),

	// Security Profile 2
	"D.2.1"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 administrator password"),
	"D.2.2"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user1 password"),
	"D.2.3"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user2 password"),
	"D.2.4"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user3 password"),
	"D.2.5"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user4 password"),
	"D.2.6"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user5 password"),
	"D.2.7"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user6 password"),
	"D.2.8"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user7 password"),
	"D.2.9"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user8 password"),
	"D.2.A"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 2 user9 password"),

	// Security Profile 3
	"D.3.1"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 administrator password"),
	"D.3.2"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user1 password"),
	"D.3.3"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user2 password"),
	"D.3.4"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user3 password"),
	"D.3.5"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user4 password"),
	"D.3.6"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user5 password"),
	"D.3.7"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user6 password"),
	"D.3.8"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user7 password"),
	"D.3.9"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user8 password"),
	"D.3.A"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 3 user9 password"),

	// Security Profile 4
	"D.4.1"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 administrator password"),
	"D.4.2"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user1 password"),
	"D.4.3"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user2 password"),
	"D.4.4"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user3 password"),
	"D.4.5"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user4 password"),
	"D.4.6"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user5 password"),
	"D.4.7"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user6 password"),
	"D.4.8"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user7 password"),
	"D.4.9"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user8 password"),
	"D.4.A"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        6, "Profile 4 user9 password"),

	"D.5.1"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        8, "KEY (for the MAC calculation)"),
	"D.6.1"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "VIS (Server Identity Verification)"),
	"D.6.2"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        8, "Client PUK_C (0)"),
	"D.6.3"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        8, "Server PUK_S (0)"),
	"D.7.1"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        4, "PIN for controlling SIM cards (10)"),

	// KEY for encryption
	"D.8.1"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYC_0 keys for AES 128"),
	"D.8.2"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYC_1 keys for AES 128"),
	"D.8.3"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYC_2 keys for AES 128"),
	"D.8.4"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYC_3 keys for AES 128"),
	"D.8.5"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYC_4 keys for AES 128"),
	"D.8.6"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYFactory keys for AES 128 (VAL_DEFAULT nemenime cez F_RDB)"),
	"D.8.A"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "KEYTemporary keys for AES 128"),
	"D.9.0"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Seal status"),
	"D.A.0"  => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_DEFAULT,        4, "Anti-fraud Totalizer (Totalizer counts: access with an incorrect encryption, authentication key and password)"),

	// Communication
	"E.0.1"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        5, "INBOUND/Voluntary SMS"),
	"FE.0.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        5, "INBOUND/Voluntary SMS - kvoli kompaktibilite s 4.02"),
	"E.1.5"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        2, "Communication mode supported (0)"),
	"E.2.1"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       22, "Telephony address for the DCE"),

	// Call map, list of telephone numbers and ip address
	"E.3.1"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.5"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.6"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.7"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.8"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.9"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.3.A"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.1"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.5"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.6"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.7"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.8"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.9"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.4.A"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.5.1"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.5.2"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.5.3"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.5.4"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),
	"E.5.5"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "Telephone reference of Clients"),

	"E.6.0"  => array( "FE.6.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Remote notification via SMS"),
	"FE.6.0" => array( "FE.6.1", VAL_TYPE_STRING16,     UNIT_DEFAULT,       15, "telephone number 1"),
	"FE.6.1" => array( "FE.6.2", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "telephone number 2"),
	"FE.6.2" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       15, "telephone number 3"),
	"E.7.0"  => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,       17, "Wakeup function"),
	"FE.7.0" => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,       17, "Wakeup function - kvoli kompaktibilite s 4.02"),
	"E.8.1"  => array(  "0.0.0", VAL_TYPE_STRING32,     UNIT_DEFAULT,       50, "DCE Configuration parameters string"),
	"E.9.1"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Timeout period for the communication session, profile 0"),
	"E.9.2"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Timeout period for the communication session, profile 1"),
	"E.9.3"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Timeout period for the communication session, profile 2"),
	"E.9.4"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Timeout period for the communication session, profile 3"),
	"E.9.5"  => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Timeout period for the communication session, profile 4"),
	"E.A.0"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Frame time out"),
	"E.A.1"  => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Inter-message time out"),
	"E.C.0"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_dB,             1, "GSM/GPRS signal intensity in dB"),
	"FE.C.0" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        6, "Diagnostika modemu pre Kamila"),

	"E.D.0"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       24, "Spontaneous/Voluntary transmission parameters1"),
	"E.D.1"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       24, "Spontaneous/Voluntary transmission parameters2"),
	"E.D.2"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       24, "Spontaneous/Voluntary transmission parameters3"),
	"E.D.3"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       24, "Spontaneous/Voluntary transmission parameters4"),
	"E.D.4"  => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       24, "Spontaneous/Voluntary transmission parameters5"),

	"E.E.1"  => array(  "0.0.0", VAL_TYPE_STRING32,     UNIT_DEFAULT,      112, "GPRS address for the DCE, APN, login, password"),
	"F.5.0"  => array( "FF.5.1", VAL_TYPE_BYTE,         UNIT_h,              3, "Battery - Residual time"),
	"FF.5.1" => array( "FF.5.2", VAL_TYPE_ULONG,        UNIT_h,              3, "Battery - converter module"),
	"FF.5.2" => array( "FF.5.3", VAL_TYPE_BYTE,         UNIT_h,              3, "Battery - data recording module"),
	"FF.5.3" => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_h,              3, "Battery - communication module"),
	"F.5.1"  => array( "FF.5.5", VAL_TYPE_BYTE,         UNIT_h,              3, "Battery - Hours of use"),
	"FF.5.5" => array( "FF.5.6", VAL_TYPE_ULONG,        UNIT_h,              3, "Battery - converter module"),
	"FF.5.6" => array( "FF.5.7", VAL_TYPE_BYTE,         UNIT_h,              3, "Battery - data recording module"),
	"FF.5.7" => array(  "0.0.0", VAL_TYPE_ULONG,        UNIT_h,              3, "Battery - communication module"),
	"F.5.2"  => array( "FF.5.8", VAL_TYPE_BYTE,         UNIT_V,              3, "Battery - Voltage value"),
	"FF.5.8" => array( "FF.5.9", VAL_TYPE_FLOAT,        UNIT_V,              3, "Battery - converter module"),
	"FF.5.9" => array( "FF.5.A", VAL_TYPE_BYTE,         UNIT_V,              3, "Battery - data recording module"),
	"FF.5.A" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_V,              3, "Battery - communication module"),

	// Functions
	"11.0.8" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        1, "Reset device"),
	"11.1.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,      101, "Force initialization of communication chanel"),
	"11.1.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,      108, "Display/Print message"),
	"11.1.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,      100, "Loopback"),
	"11.1.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        3, "Reset alarm queue"),
	"11.0.0" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Reset event queue (metrolog switch - nazor Zdenka)"),
	"11.1.6" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        8, "Activate/Deactivate the sender recognition function"),
	"11.1.7" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Force a call"),
	"11.0.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        0, "Restoring default values"),
	"11.0.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        0, "Database reset (nazor Zdenka)"),
	"11.0.1" => array(  "0.0.0", VAL_TYPE_DATETIME,     UNIT_DEFAULT,       10, "Set Date and Time"),
	"11.0.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        1, "Modify the device status"),
	"11.0.5" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        7, "Modify/Activate password"),
	"11.1.8" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,      120, "Create a table structure"),
	"11.0.6" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Deactivating electronic seals"),
	"11.0.7" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        1, "Activating electronic seals"),
	"11.0.A" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "Battery change"),
	"11.0.B" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       75, "Configure a Tariff Scheme"),
	"11.0.9" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        0, "Reset diagnostics"),
	"11.0.C" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Activate/Deactivate KEYT"),
	"11.0.D" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       80, "Modify encryption key"),
	"11.0.E" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       16, "Modify temporary encryption key"),
	"11.F.E" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        0, "Write Instalation Event"),
	"11.F.F" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        1, "Default Access"),
	"91.1.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        1, "Vypnut/zapnut serv. prepinac"),

	// Events/Count of events
	"10.0.1" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,       18, "Events"),
	"10.0.2" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,       18, "Total alarm-type events logged"),
	"10.0.3" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,       40, "Total trigger events logged"),

	"10.1.0" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Number of Events"),
	"10.2.0" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Total alarm-type events logged"),
	"10.3.0" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        1, "Total trigger events logged"),
	"10.4.0" => array(  "0.0.0", VAL_TYPE_UINT,         UNIT_DEFAULT,        2, "Configuration of Trigger Events"),

	"12.0.0" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Device status"),
	"12.1.0" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "Diagnostics - Extended format"),
	"12.1.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "Diagnostics - Extended format"),
	"12.1.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "Diagnostics - Extended format"),
	"12.1.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "Diagnostics - Extended format"),
	"12.2.0" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Diagnostics - Abridged format"),
	"12.2.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Diagnostics - Abridged format"),
	"12.2.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Diagnostics - Abridged format"),
	"12.2.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Diagnostics - Abridged format"),
	"12.3.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        9, "Status of sensors"),
	"12.4.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        3, "System status – Mains power"),
	"12.4.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "System status - DCE status"),
	"12.6.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Historic Diagnostics – 1 h average"),
	"12.6.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Historic Diagnostics – 1 d average"),
	"12.6.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Historic Diagnostics – 1 m average"),
	"12.6.6" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        2, "Historic Diagnostics – Recorded at the end of the billing period"),

	// Category I/O
	"13.0.0" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "Stat_DI_ - Digital inputs - Status"),
	"13.0.1" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        1, "SA_DI_ - Digital inputs - Alarm Status"),

	"13.4.1" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       19, "Conf_DO_1 - Digital outputs configuration 1"),
	"13.4.2" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       19, "Conf_DO_2 - Digital outputs configuration 2"),
	"13.4.3" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       19, "Conf_DO_3 - Digital outputs configuration 3"),
	"13.4.4" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       19, "Conf_DO_4 - Digital outputs configuration 4"),

	"13.6.1" => array( "F3.6.1", VAL_TYPE_BYTE,         UNIT_bar,            2, "Conf_P_ - Metering pressure transducer - Configuration"),
	"F3.6.1" => array( "F3.6.2", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Conf_P_ - S03"),
	"F3.6.2" => array( "F3.6.3", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Conf_P_ - S04"),
	"F3.6.3" => array( "F3.6.4", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Conf_P_ - A01"),
	"F3.6.4" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_bar,            3, "Conf_P_ - A01"),
	"13.6.2" => array( "F3.6.5", VAL_TYPE_BYTE,         UNIT_Kelvin,         1, "Conf_T_ - Metering temperature transducer - Configuration"),
	"F3.6.5" => array( "F3.6.6", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Conf_P_ -"),
	"F3.6.6" => array( "F3.6.7", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Conf_P_ -"),
	"F3.6.7" => array( "F3.6.8", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Conf_P_ -"),
	"F3.6.8" => array(  "0.0.0", VAL_TYPE_FLOAT,        UNIT_Kelvin,         3, "Conf_P_ -"),
	"13.7.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_DEFAULT,        3, "Imp_Vm - Measuremend Volume Pulse weight - Input"),
	"13.7.2" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        3, "Imp_Vbs - Converted Volumes Pulse weight at standard conditions - Input"),

	"15.0.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Supported by the device"),
	"15.0.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Supported by the device"),
	"15.0.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Supported by the device"),
	"15.0.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Supported by the device"),
	"15.0.5" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Supported by the device"),

	"15.1.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Active"),
	"15.1.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Active"),
	"15.1.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Active"),
	"15.1.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Active"),
	"15.1.5" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       33, "TRACES Active"),
	"15.2.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       48, "Array Active"),

	// Band totalizer category
	// Tototalizer for volumes at the measurement conditions in band F1-F3
	"18.0.0" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1"),
	"18.0.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1_15"),
	"18.0.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1_h"),
	"18.0.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1_g"),
	"18.0.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1_m"),
	"18.0.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1_y"),
	"18.0.6" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F1_pf"),

	"18.1.0" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2"),
	"18.1.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2_15"),
	"18.1.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2_h"),
	"18.1.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2_g"),
	"18.1.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2_m"),
	"18.1.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2_y"),
	"18.1.6" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F2_pf"),

	"18.2.0" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3"),
	"18.2.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3_15"),
	"18.2.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3_h"),
	"18.2.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3_g"),
	"18.2.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3_m"),
	"18.2.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3_y"),
	"18.2.6" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vm_F3_pf"),

	// Totalizer for volumes at the standard thermodynamic conditions in band F1-F3
	"18.3.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F1_15"),
	"18.3.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F1_h"),
	"18.3.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F1_g"),
	"18.3.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F1_m"),
	"18.3.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F1_y"),

	"18.4.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F2_15"),
	"18.4.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F2_h"),
	"18.4.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F2_g"),
	"18.4.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F2_m"),
	"18.4.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F2_y"),

	"18.5.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F3_15"),
	"18.5.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F3_h"),
	"18.5.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F3_g"),
	"18.5.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F3_m"),
	"18.5.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vb_F3_y"),

	// Totalizer for volumes measured under error conditions in band F1-F3
	"18.6.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F1_15"),
	"18.6.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F1_h"),
	"18.6.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F1_g"),
	"18.6.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F1_m"),
	"18.6.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F1_y"),

	"18.7.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F2_15"),
	"18.7.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F2_h"),
	"18.7.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F2_g"),
	"18.7.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F2_m"),
	"18.7.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F2_y"),

	"18.8.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F3_15"),
	"18.8.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F3_h"),
	"18.8.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F3_g"),
	"18.8.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F3_m"),
	"18.8.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vme_F3_y"),

	// Totalizer for volumes measured as at the standard thermodynamic conditions recorded under error conditions in band F1-F3
	"18.9.0" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1"),
	"18.9.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1_15"),
	"18.9.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1_h"),
	"18.9.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1_g"),
	"18.9.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1_m"),
	"18.9.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1_y"),
	"18.9.6" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F1_pf"),

	"18.A.0" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2"),
	"18.A.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2_15"),
	"18.A.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2_h"),
	"18.A.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2_g"),
	"18.A.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2_m"),
	"18.A.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2_y"),
	"18.A.6" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F2_pf"),

	"18.B.0" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3"),
	"18.B.1" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3_15"),
	"18.B.2" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3_h"),
	"18.B.3" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3_g"),
	"18.B.4" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3_m"),
	"18.B.5" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3_y"),
	"18.B.6" => array(  "0.0.0", VAL_TYPE_DOUBLE,       UNIT_m3,             4, "Tot_Vbe_F3_pf"),

	"17.0.0" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       73, "Tariff Scheme"),
	"17.0.1" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,       73, "Tariff Scheme"),
	"17.0.2" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        3, "Billing period"),
	"17.0.3" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        6, "Switch Date"),
	"17.0.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        9, "ID-PT - Tariff Scheme ID"),
	"F7.0.4" => array(  "0.0.0", VAL_TYPE_DEFAULT,      UNIT_DEFAULT,        4, "ID-PT - PT_ID only for DECF table"),

	// interne, elgas
	"FF.0.1" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,        5, "Sizeof CTR_List and CTR_Access"),
	"FF.0.2" => array(  "0.0.0", VAL_TYPE_BYTE,         UNIT_DEFAULT,       10, "Space"),
	"FC.0.0" => array(  "0.0.0", VAL_TYPE_STRING16,     UNIT_DEFAULT,       10, "first 10 chars of PDR"),
	"FC.0.1" => array(  "0.0.0", VAL_TYPE_STRING8,      UNIT_DEFAULT,        4, "last 4 chars of PDR"),
);

/*----------------------------------------------------------------------------*/
/* END OF FILE */
