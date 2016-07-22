<?php

function ctr_crypt($str, $numOfBlocks, $key, $iv) {

	$ctrStr = '';
	for ($i = 0; $i < $numOfBlocks; ++$i) {
		$ctrStr .= $iv;

		// increment IV
		for ($j = 15; $j > 0; --$j) {
			$n = ord($iv[$j]);
			if (++$n == 0x100) {
				// overflow, set this one to 0, increment next
				$iv[$j] = "\0";
			} else {
				// no overflow, just write incremented number back and abort
				$iv[$j] = chr($n);
				break;
			}
		}
	}

	return $str ^ mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $ctrStr, MCRYPT_MODE_ECB);
}
