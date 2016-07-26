<?php
	require("time_meas.php");
	require("aes.php");
	require("keys.inc");
	require("ctr_structure.php");
	if(IsSet($_REQUEST["XDEBUG_SESSION_START"]))
	{
  		$_REQUEST["CTR_FRAME"] = "00014861DEEE254CE06F4B43128DD7366E817E5B1B1FFAE40DDF79FD0D6661CBC6E9FC1E674B722AC997711B04F572034721D5D9C6552344948217FC4940206078FE76F846C086C8C42F21DFBCAA51947013FF51552EC33135B3CDC80880265920FC600ED76203ADD6CA2EF9936B97890D44740305A5049C6632AC3BDB41E197C21E51A17F674B94598F13CE";
  		$_REQUEST["CTR_FRAME"] = "000148610271D744C3EB0A2DEBD68A11F261FC4B82A69409164DD6538E70A189B9B48377653280441D2F8FB6944601FD92993FE60D83F0DB18072FAA9414A8044C57DB1ED2339CF7B2BAE33113F692CBF1E8A92A955DC1DFA2848704CDC301AB2004AD2D1FCD477F09E0D64F1B3D442D19AD31F5AF09E32CFED87BA7E5654E1D4FA697CE595C5FBA96337B4E";
  		$_REQUEST["Key"] = $admin_key;
  		$_REQUEST["encrypt"] = "";
	}

	$CTR_FRAME_ENCRYPT = $_REQUEST["CTR_FRAME_ENCRYPT"];
	
	if( IsSet($_REQUEST["encrypt"]))
	{
		$input_raw = substr($_REQUEST["CTR_FRAME"], 8, 260);
		$input  = pack("H*" , $input_raw);
		$key    = pack("H*" , $_REQUEST["Key"]);
		$cpa    = substr($_REQUEST["CTR_FRAME"], 268, 8);
		$iv     = pack("H*" , $cpa. $cpa. $cpa. $cpa);

		$CTR_FRAME_ENCRYPT = bin2hex( ctr_crypt($input, 9, $key, $iv));
		$CTR_FRAME_ENCRYPT = substr($_REQUEST["CTR_FRAME"], 0, 8)
		                    .$CTR_FRAME_ENCRYPT
		                    .$cpa
		                    .substr($_REQUEST["CTR_FRAME"], 276, 4);
	}
?>

<!doctype HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=UTF-8'>
	<meta name='author' lang='en' content='Zdeno Sekerák, www.trsek.com'>
	<link rel='shortcut icon' href='/favicon.ico'>
	<link rel='stylesheet' href='ctr.css'>
	<title>CTR online</title>
</head>
<body>
<h1>CTR Encrypt online</h1>

<table>
<form action='' method='post' ENCTYPE='multipart/form-data' class='form-style-two'>
	Input packet (hex format)<br>
	<textarea name='CTR_FRAME' rows="3" cols="102"><? echo $_REQUEST["CTR_FRAME"]?></textarea><br>
	Key<br>
	<input type='text' name='Key' value='<? echo $_REQUEST["Key"]?>' size=38><br>
	<input type='submit' name='encrypt' value='aes encrypt'><br>
	<br>Encrypt packet<br>
	<textarea name='CTR_FRAME_ENCRYPT' rows="3" cols="102"><? echo $CTR_FRAME_ENCRYPT?></textarea><br>
	<input type='submit' name='analyze' value='analyze'><br>
	<br>Frame<br>
	<?php
	$out = ctr_show($CTR_FRAME_ENCRYPT);
	echo $out; 
	?>
</form>
</table>

<?php
	require("paticka.php");
?>