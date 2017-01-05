<?php
/* 
Copyright (C) 2016 TheScene.Co
This file is part of TheScene.Co PHP Client SDK.

Author: M Yasir Siddique
Email: yasir2014@gmail.com

TheScene.Co PHP Client SDK is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

TheScene.Co PHP Client SDK is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Lesser General Public License for more details.

You should have received a copy of the Lesser GNU General Public License.
*/

require_once("../../../../wp-load.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
    if(isset($_POST['thescene_submit']))
    {   
    	
    	if($_POST['thescene_clientID'] != '' && $_POST['thescene_secret'] != '')
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
		else
		{
	    	$location = $_SERVER['HTTP_REFERER'].'&action=failure';
			header("Location: $location");
		}

    }

}