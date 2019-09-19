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
  		$_REQUEST["Key"] = $admin_key;
	}

	$CTR_FRAME = CTR_NORMALIZE($_REQUEST["CTR_FRAME"]);
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
	<textarea name='CTR_FRAME' rows="3" cols="94"><?php echo $CTR_FRAME;?></textarea><br>
	Key (if needed)<br>
	<input type='text' name='Key' value='<?php echo $_REQUEST["Key"];?>' size=38><br>
	<?php if( ctr_IsEncrypt($CTR_FRAME)) {
		$CTR_FRAME = ctr_Decrypt($CTR_FRAME, $_REQUEST["Key"]); ?>
		Packet without encrypt<br>
		<textarea readonly name='CTR_FRAME_ENCRYPT' rows="3" cols="94"><?php echo $CTR_FRAME;?></textarea><br>
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