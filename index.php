<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	require("time_meas.php");
	require("aes/keys.inc");
	require("ctr_structure.php");
	require("example.php");
	
	$debug_cesta = "";
	// some example for debug mode
	if(IsSet($_REQUEST["XDEBUG_SESSION_START"]))
	{
		$debug_cesta = "/ctr/";
		$_REQUEST["CTR_FRAME"] = "00014861DEEE254CE06F4B43128DD7366E817E5B1B1FFAE40DDF79FD0D6661CBC6E9FC1E674B722AC997711B04F572034721D5D9C6552344948217FC4940206078FE76F846C086C8C42F21DFBCAA51947013FF51552EC33135B3CDC80880265920FC600ED76203ADD6CA2EF9936B97890D44740305A5049C6632AC3BDB41E197C21E51A17F674B94598F13CE";
		$_REQUEST["CTR_FRAME"] = "000148610271D744C3EB0A2DEBD68A11F261FC4B82A69409164DD6538E70A189B9B48377653280441D2F8FB6944601FD92993FE60D83F0DB18072FAA9414A8044C57DB1ED2339CF7B2BAE33113F692CBF1E8A92A955DC1DFA2848704CDC301AB2004AD2D1FCD477F09E0D64F1B3D442D19AD31F5AF09E32CFED87BA7E5654E1D4FA697CE595C5FBA96337B4E";
		$_REQUEST["CTR_FRAME"] = "0AFFFF003F500000000000000001030ED000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001D620D";
		$_REQUEST["CTR_FRAME"] = "0000002D0000413F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005B25";
		$_REQUEST["CTR_FRAME"] = "FFFF0026000030303030303110071A00111701030001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000027EC";
		$_REQUEST["CTR_FRAME"] = "0000002150010103FCFFFF000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000EC4";
		$_REQUEST["CTR_FRAME"] = "0000002D00004B26111400000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000525";
		$_REQUEST["CTR_FRAME"] = "0000002B000030244657312E080000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000E37A";
		$_REQUEST["CTR_FRAME"] = "0a000000250000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000208d0d";
		$_REQUEST["CTR_FRAME"] = "00010061530103081000927857100404240506000000050101221004032400EFB81BE4000196E4000195E400019CE400019AE40001A0E400019FE40001A7E40001A7E40001A6E40001A5E40001A5E40001AFE40001A7E40001A8E40001A0E40001ABE40001ADE40001ACE40001ADE40001A5E40001AEE40001A4E40001A510FFFFFF10FFFFFF11D43327";
		$_REQUEST["CTR_FRAME"] = "00010061540103081000927857100404240506000000050101221004032400EFB81BE4000196E4000195E400019CE400019AE40001A0E400019FE40001A7E40001A7E40001A6E40001A5E40001A5E40001AFE40001A7E40001A8E40001A0E40001ABE40001ADE40001ACE40001ADE40001A5E40001AEE40001A4E40001A510FFFFFF10FFFFFF11D43327";
		$_REQUEST["CTR_FRAME"] = "FFFF487F07CFDA8B85FB4C0F0ABEAB6951316982573514951596C048C54DE06C062B14D9F9F62CEA1BBD9773CE10451C31034FF3CCFD4A45A9C458CD035F27FCAF3F9985201BD8EA9A3BE2DBC6395F6F9EC746829976C7D9D547077F5623913D9D54EEB3BC44B698C4B4088AC762DA27C9A6DC7CB7485F3009B9BC5B50DCB11D65C45792487FF16C3DB5206E";
		$_REQUEST["CTR_FRAME"] = "00010061500109030120A20D5FB40400A40026C70700A20074ED0813A0060902A05049434F000A00A40024D70A7010FFFFFF0A9010FFFFFF0EC0A08F0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000A75
0000002D0000413F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005B25
FFFF003F5300303030303031FF55010D09090000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000002875
0000002B000030244657312E080000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000E37A";
		$_REQUEST["CTR_FRAME"] = "0a0001007f5c9e1033f4ef43eed97879972bb129f8b60fb32cf4a186882443984d7a210af4ebe486a0cb93c77b13f06747745a1887dc75ea61dc97a43d9aefd29a34662dee3b4d71ce5f144e4a402fc2276935a343f52935cba6ab54f9360714c9f9d75bd572b221df2828712f060dba03abbe44125d8cc5201bd375cb3ddab7a5925e1f3a821ee43ac23b23e20d
		0a000100614c1b78443c94fd0484c176ea02b9a30e88d9b888a0733d1918645267f8030bc61051477b462eb7050a2c4bf8c45ed5839afef0363db890c7b83e798ebcf632932ac1d380d211bb664bf9903dca2be4dcca1e2c383d5c33112e35b272c8b5a5a786eb78dcf007995899d14b011a7961141a3220ed79d1ad0776839689fe8601f65f12dea61d43deda0d";
		$_REQUEST["CTR_FRAME"] = "FFFF8024000015041E004657312E070701505DF775D53E02CA60E6526EC2BB08A3091BE10F0D6A389702363652857BAC911D33A8FC0C64F7675D9A2C1A4BCD8A30F625D8F687CC5058C9A39F272C86118A77AC65548230F7D8CE46C13F775CD5C2C669D2D4F39DD0250DC0709B5AE4EAEB1CA9F55E3E256710E42BF629135B0F5943230A7FE4998B8903F53D7F42FFD0FF6B5B3AECD7E0430C1427BA3B9F56775FC6D0A1070661C13CC4CF45625B2C6FB861EB74E22313AFF5374FB86E729F4C907F9E1E5D30C7F52A6D61A41E0AC6207934C3889562232C557AAE699D437CA7D8C9BC79BC9AD0C7F2BD5CFF36A3745DBD5DEECC82FF1D7AAF29A12FBA4208A581A7D63C927EC189D8C35E8F5AC8B3B90D7E127A7E9A46DCD111EEBF9374538A66133FF8F044A99A8D803F821F191B1E3AFE230BF9CEE41459F92F4F1E14A93F007297ACA8388CF8EB31798775B7BC407D43467E3DED9019B2332C694A7DEA402C4C74FA3405FB5A5A9BD694FC1661177DEE2CE92EB4A26A930E02A5FBC63F33138415EF736C427DD223253FC57FE8FF6F6C49AFB006C544B9A3E618C4CD22F2D7B097C982F3B1CD8BDFBA290306E5EB544CB5A6901015CD94BB88EB5A3DE4DD43D8F54F390BE0DBD8A858F525F52791CEC741A634B1A039BABB062E11DB03B61F1BC9B9FC902A7749526CD91E4F5602C7D9D66A79E803BE3A9FD252EE49734CDEC05B705E91C359F19B92EF603B28993EB3D2939664F597BAEE47A01985FF63BE3A118770062BB8E5E304F8FD34F100E21BA10D813FC77EFA8F9204A014909A2C7997D29CEFFB465E06BD74CB4970D7768E3A98088D7B103F7F33DB99CE3CA89E32295F0C0B6D93AB25D976666F0ED8107AED43ED4CE2C3FC9A7FD7F815E914677FFCBB66677E53297FE8D9AF02F010515335DDDFE8C69B4A3ADB3E229B10DBDCAAA2FF67D23BAC0B1BF2C6358534B4BCD239DD211E013B5C234D02E2F43BF864373F9200EE5AA021D26127275E11B182FE1A6702728694432B7FCA346163EE3816633D8E496599F4D743E76751225F074D703CCD7AB343FECAD1646A88D421714C89EB6ABD2A89E5C3E5BF5D9F0EABE0C87763A5EF1D8742786DCB95C709C7552514689FBC0C6CECFF0F7D41FB07BC0AA9BB850262C4160D85A5A216C4B2A06F7FACB4A7308E76A6941B55E8A544314F0E7E38B2ED832BD7661EB7FF78D5B76F9A16EE74801A9C8EAF593092D35F9DEF3F455386FB9E3628962290D7B4A40227653BD7F4FFA26DB6B3FB0286C26E9370D2B8CB3FE5E686B5D3340602FF0EC2B96AF46FAFEC0C2D698333CD087AF14BAB32B5502B4867A98F9BF30E0CAC4489BBA39E2162786062E18DB0754D0FFA0AA348F3B44B2594CB2B04DFA9CB0C7177F69A4BF56D747401FAC23BBB9646FDF8F5447620EF9F3540457C709C9EAB2C4A";
		$_REQUEST["CTR_FRAME"] = "0001002B000030244657312E0707014A014B014C014D014E014F015000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000002111";
		$_REQUEST["Key"] = $admin_key;
	}

	if( isset($_REQUEST["FRAME"]))
		$_REQUEST["CTR_FRAME"] = $_REQUEST["FRAME"];

	$CTR_FRAME = CTR_NORMALIZE($_REQUEST["CTR_FRAME"]);
	
	// pre app
	if( isset($_REQUEST["FLAT"])) {
		echo "<head><meta HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'><link rel='stylesheet' href='ctr_flat.css'></head>";
		echo ctr_show($CTR_FRAME);
		return;
	}
?>

<!doctype HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'>
	<meta name='author' lang='en' content='Zdeno Sekerák, www.trsek.com'>
	<link rel='shortcut icon' href='favicon.ico'>
	<link rel='stylesheet' href='<?php echo $debug_cesta?>ctr.css'>
	<title>CTR online (<?php echo ctr_funct_name(hexdec(substr($CTR_FRAME, 6, 2)) & 0x3F);?>)</title>
	<script type="text/javascript" src="<?php echo $debug_cesta?>togglemenu.js"></script>
</head>
<body>
<h1>CTR Encrypt online</h1>

<?php echo show_example();?>
<form action='index.php' method='post' ENCTYPE='multipart/form-data' class='form-style-two'>
	Packet (hex format)<br>
	<textarea name='CTR_FRAME' rows="4" cols="100"><?php echo $CTR_FRAME;?></textarea><br>
	Key (if needed)<br>
	<input type='text' name='Key' value='<?php echo $_REQUEST["Key"];?>' size=38><br>
	<?php if( ctr_IsEncrypt($CTR_FRAME)) {
		$CTR_FRAME = ctr_Decrypt($CTR_FRAME, $_REQUEST["Key"]); ?>
		Packet without encrypt<br>
		<textarea readonly name='CTR_FRAME_ENCRYPT' rows="4" cols="100"><?php echo $CTR_FRAME;?></textarea><br>
	<?php } ?>
	<input type='submit' name='analyze' value='analyze'><br>
</form>

<br>Frame<br>
<?php
//var_dump($GLOBALS);
echo ctr_show($CTR_FRAME);
?>

<?php
	require("paticka.php");
?>