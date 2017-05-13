<?php
require_once("funct/funct_name.php");
require_once("struct/struct_name.php");

define (EXAMPLE_PACKET,     0);
define (EXAMPLE_PACKET_KEY, 1);

$example_packet = array(
		$funct_code[CTR_QUERY       ][CTR_FUNCT_DESC] => array("FFFF007FE8364CC9EA8E6DF6CB3A8A97E1FB6ED9B4024FB9A949F58FD236C8AECB5F3684013E63503DA593ED81FE5BF4E09A3542B8B9ADE0872A0EDD1DAB939BBA0DB6E9D3D2C43F5309B0D3AF1A4812D156FBD944AC38CEC1EA743FD6D0B19519550EF20B0CA5DDF9EB58F92FC9A720337BC51942E3E483096A4296CEDD5CB223FA31025FA4337EEFC593B7","11111111111111111111111111111111"),
		$funct_code[CTR_ANSWER      ][CTR_FUNCT_DESC] => array("000100618964C1EB198D278D85CE881AA99CC25965AC14D223EE71BAA9471284F41E51B13CBB2DBF7F060D47DC013DDA37755692E94EE3512509729C41DEBF7E308F63320D264558EFDC513FD893A5DD5C813F0318319430F3DCFE23466EEF8E70D810905F020F35589EA9B68EA07BE0E08D90D947B34B1E015BB37A57969E6C6987C81DA82B2CF151A60A75","11111111111111111111111111111111"),
		$funct_code[CTR_ACK         ][CTR_FUNCT_DESC] => array("0000002B000030244657312E080000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000E37A",""),
		$funct_code[CTR_NACK        ][CTR_FUNCT_DESC] => array("0000002D0000413F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005B25",""),
		$funct_code[CTR_IDENTIF     ][CTR_FUNCT_DESC] => array("000000283000584B25440FE06AF10000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000091BF",""),
		$funct_code[CTR_IDENTIF_ANSW][CTR_FUNCT_DESC] => array("00010029300000000000001111454C474153000000000000005049434F005049434F312E3131000042424252313231010100089A4D454D4200000030303031343434303034333835015F0000820182E64288CDBB0FA40E01FFFFFFFF0E0A103946424200000000000000000000000000000000003030303030303134343430303433383500003B769CBF5F7B",""),
		$funct_code[CTR_VOLUNTARY   ][CTR_FUNCT_DESC] => array("0013007B5301000000000000190B0209101C04000800000101020B0208010026FEF7000000CF000000CF000000CF000000CF000000CF000000CF000000CF000000CE000000CF000000CF000000CF000000CF000000CF000000CF000000CF000000CF000000CE000000CF000000CF000000CF000000CF000000CF000000CF000000CFFFFF1382000000008B7E",""),
		$funct_code[CTR_EXECUTE     ][CTR_FUNCT_DESC] => array("FFFF0026000030303030303110071A00111701030001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000027EC",""),
		$funct_code[CTR_WRITE       ][CTR_FUNCT_DESC] => array("FFFF002F500030303030303110071C000001030ED0005301222953010229000000290000002900000000330000FF00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000073AEEDA1151",""),
		$funct_code[CTR_END         ][CTR_FUNCT_DESC] => array("000000250000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000208d",""),
		$funct_code[CTR_SECRET      ][CTR_FUNCT_DESC] => array("FFFF0023000030303030303110071C0000111111111111111111111111111111110D0215222222222222222222222222222222220D0215333333333333333333333333333333330D0215000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000073AEEDAFA14",""),
		$funct_code[CTR_DOWNLOAD    ][CTR_FUNCT_DESC] => array("FFFF0024000010071C004657312E0000000010061E3030303020312E30302020000962E80268000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000A81ED34FC51A",""),
		$struct_code[CTR_STR_TRACE_C][0]              => array("00010021530100000000001111100806242506000A016101012210071E2400D8C92DA4030729A4030728A4030727A4032C0BA4030725E403071FE4030723E4030721E4030721E4030722E4030724E403072AE403072BE4032C1EE4030734E4030736E403510EE402E252E403073FE4032C29E4030740E403073FE403073DA4032C2710FFFFFF00000000B465",""),
);


/********************************************************************
* @brief Example is need
*/
function is_example_time()
{
	if( empty($_POST) && empty($_GET))
		return true;
	
	return false;
}

/********************************************************************
* @brief Show links to example
*/
function show_example()
{
	if( !is_example_time())
		return;
	
	global $example_packet;
	$out = "Examples<br>";
	
	foreach ($example_packet as $example_name => $example_packet_list)
	{
		if( $example_packet_list[EXAMPLE_PACKET_KEY])
			$link = "index.php?CTR_FRAME=". $example_packet_list[EXAMPLE_PACKET] ."&Key=". $example_packet_list[EXAMPLE_PACKET_KEY] ."&encrypt";
		else
			$link = "index.php?CTR_FRAME=". $example_packet_list[EXAMPLE_PACKET] ."";

		$out .= "<a href='$link'>[". $example_name."]</a>&nbsp;";	
	}
	$out .= "<br><br>";
	return $out; 
}

/*----------------------------------------------------------------------------*/
/* END OF FILE */