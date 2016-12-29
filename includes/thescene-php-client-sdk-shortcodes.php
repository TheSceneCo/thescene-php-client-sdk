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

function thescene_shortcode($atts, $content = null){

    if(get_option('thescene_clientID') !== '' && get_option('thescene_secret') !== '')
    {

        require_once('thescene-php-client-sdk-verify.php');

        $thescene_clientid = thescene_decrypt(get_option('thescene_clientID'));
        $thescene_secret = thescene_decrypt(get_option('thescene_secret'));
        $thescene_venueid = thescene_decrypt(get_option('thescene_venueID'));

        $url_master = "http://thescene.co/";
        $output = "";               
        
        $url_oauth = $url_master."auth/oauth/token?grant_type=client_credentials";

        $ch_oauth = curl_init($url_oauth);
        curl_setopt($ch_oauth, CURLOPT_POST, 1);
        curl_setopt($ch_oauth, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ; 
        curl_setopt($ch_oauth, CURLOPT_USERPWD, "$thescene_clientid:$thescene_secret");
        curl_setopt($ch_oauth, CURLOPT_RETURNTRANSFER, true);
        $response_oauth = curl_exec($ch_oauth);
        $result_oauth = json_decode($response_oauth, true);
        curl_close($ch_oauth);
        //var_dump($result_oauth);

        //////////////////////////////////////////////////////////////////////////////////////////////

        $url_welcome = $url_master."api";

        $ch_welcome = curl_init($url_welcome);
        curl_setopt($ch_welcome, CURLOPT_HTTPHEADER, 
            array('Authorization: bearer '.$result_oauth['access_token'])
        );
        curl_setopt($ch_welcome, CURLOPT_RETURNTRANSFER, true);
        $response_welcome = curl_exec($ch_welcome);
        $result_welcome = json_decode($response_welcome, true);
        curl_close($ch_welcome);
        //var_dump($result_welcome);

        //////////////////////////////////////////////////////////////////////////////////////////////

        $get_url_events = array_filter(explode('{', $result_welcome['_links']['events']['href']));
        $output = thescene_events($result_oauth['access_token'], $get_url_events[0]);

    }
    else
    {
        $output = 'Please enter your ClientID and Secret on TheScene.Co Settings Page.';       
    }

    return $output;

}

add_shortcode('thescene', 'thescene_shortcode');

function thescene_events($access_token, $url_events){

    $thescene_events = '';

    $ch_events = curl_init($url_events);
    curl_setopt($ch_events, CURLOPT_HTTPHEADER, 
        array('Authorization: bearer '.$access_token)
    );
    curl_setopt($ch_events, CURLOPT_RETURNTRANSFER, true);
    $response_events = curl_exec($ch_events);
    $result_events = json_decode($response_events, true);
    curl_close($ch_events);
    //$thescene_events .= '<pre>'.print_r($result_events, true).'</pre>';
    $thescene_events .= '<div class="thescene_events">';
    foreach ($result_events['_embedded']['events'] as $single_event) {
        $thescene_events .= '<p class="thescene_event">';
            $thescene_events .= '<span class="thescene_event_line">'.$single_event['eventName'].'</span>';
            if($single_event['startTime'] != '')
            {
                $thescene_events .= '<span class="thescene_event_line">'.date('d-m-Y H:i:s T', $single_event['startTime']).'</span>';
            }
            if($single_event['endTime'] != '')
            {
                $thescene_events .= '<span class="thescene_event_line">'.date('d-m-Y H:i:s T', $single_event['endTime']).'</span>';
            }
            $thescene_events .= '<span class="thescene_event_line">'.$single_event['shortDescription'].'</span>';
            $thescene_events .= '<span class="thescene_event_line"><a href="http://thescene.co">More information</a></span>';
        $thescene_events .= '</p>';
    }
    $thescene_events .= '</div>';

    return $thescene_events;
}