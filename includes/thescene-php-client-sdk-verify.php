<?php

function thescene_encrypt($thescene_text)
{
	$thescene_salt = 'P{l}f&0D*|=LxXI$j3[<!g5P*P@w407';
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $thescene_salt, $thescene_text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
}

function thescene_decrypt($thescene_text)
{ 
	$thescene_salt = 'P{l}f&0D*|=LxXI$j3[<!g5P*P@w407'; 
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $thescene_salt, base64_decode($thescene_text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
}