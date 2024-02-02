<?php

function generateToken($length){
    $alphaNum ="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            return    substr(str_shuffle(str_repeat($alphaNum,$length)),0,$length);
            die();
}
/* function generateToken($length){
	 	$alphaNum = "0123456789abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			
		return 	substr( str_shuffle(str_repeat($alphaNum, $length)),0,$length);

	 }
?> */

?>