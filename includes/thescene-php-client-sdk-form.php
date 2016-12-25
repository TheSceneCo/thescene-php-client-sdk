<?php

require_once("../../../../wp-load.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
    if(isset($_POST['thescene_submit']))
    {   
    	require_once('thescene-php-client-sdk-verify.php');

		$thescene_clientID = thescene_encrypt($_POST['thescene_clientID']);
		$thescene_secret = thescene_encrypt($_POST['thescene_secret']);
		$thescene_venueID = thescene_encrypt($_POST['thescene_venueID']);

		update_option( 'thescene_clientID', $thescene_clientID, 'no' );
		update_option( 'thescene_secret', $thescene_secret, 'no' );
		update_option( 'thescene_venueID', $thescene_venueid, 'no' );

    	$location = $_SERVER['HTTP_REFERER'].'&action=success';
		header("Location: $location");
    }

}