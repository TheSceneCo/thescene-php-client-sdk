<?php
/* 
Plugin Name: thescene-php-client-sdk
Description: It will make use of <a href="http://thescene.co/">TheScene.Co</a> API.
Version: 1.0.0
Author: <a href="mailto:yasir2014@gmail.com">Yasir</a>
License:     GPL3

Copyright (C) 2016 TheScene.Co
This file is part of TheScene.Co PHP Client SDK.

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

//Exit if Accessed Directly
if(!defined('ABSPATH')){
    exit;
}

//Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/thescene-php-client-sdk-scripts.php');

//Load Shortcodes
require_once(plugin_dir_path(__FILE__).'/includes/thescene-php-client-sdk-shortcodes.php');

//Load Settings
require_once(plugin_dir_path(__FILE__).'includes/thescene-php-client-sdk-settings.php');

function thescene_activation() {
}


register_uninstall_hook(__FILE__, 'thescene_uninstall');

function thescene_uninstall() {
	delete_option('thescene_clientID');
	delete_option('thescene_secret');
	delete_option('thescene_venueID');
}