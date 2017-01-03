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

function thescene_options_menu_link(){

    add_options_page(
        'TheScene Options',
        'TheScene Settings',
        'manage_options',
        'thescene-options',
        'thescene_options_content'
    );

}

function thescene_options_content(){

    require_once('thescene-php-client-sdk-verify.php');
    ?>
    <div class="wrap">
  
        <h2><?php _e('TheScene Settings Page', 'thescene_domain') ?></h2>
        <p><?php _e('Settings for the TheScene API', 'thescene_domain') ?></p>

        <?php
        if(isset($_GET['action']))
        {                
            if($_GET['action'] == 'success')
            {
                echo '<p class="notice notice-success">'.__('Data has been Saved.', 'thescene_domain').'</p>';
            }
            elseif ($_GET['action'] == 'failure')
            {
                echo '<p class="notice notice-error">'.__('Atleast ClientID and Secret should not be Empty.', 'thescene_domain').'</p>';
            }
        }
        ?>

        <form method="post" action="<?php echo plugins_url().'/thescene-php-client-sdk-master/includes/thescene-php-client-sdk-form.php'; ?>">
       
            <table class="form-table">
                <tbody>                             
                <tr> 
                    <td>
                        <input type="text" name="thescene_clientID" id="thescene_clientID" value="<?php if(get_option('thescene_clientID') != ''){ echo thescene_decrypt(get_option('thescene_clientID')); } ?>" class="regular-text" />
                        <p class="description" id="thescene_clientID"><?php _e('Enter your ClientID', 'thescene_domain') ?></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="text" name="thescene_secret" id="thescene_secret" value="<?php if(get_option('thescene_secret') != ''){ echo thescene_decrypt(get_option('thescene_secret')); } ?>" class="regular-text" />
                        <p class="description" id="thescene_secret"><?php _e('Enter your Secret', 'thescene_domain') ?></p>
                    </td>
                </tr>                

                <tr>
                    <td>
                        <input type="text" name="thescene_venueID" id="thescene_venueID" value="<?php if(get_option('thescene_venueID') != ''){ echo thescene_decrypt(get_option('thescene_venueID')); } ?>" class="regular-text" />
                        <p class="description" id="thescene_venueID"><?php _e('Enter your VenueID', 'thescene_domain') ?></p>
                    </td>
                </tr>              
                </tbody>
            </table>
            <p class="submit"><input type="submit" name="thescene_submit" id="thescene_submit" class="button" value="<?php _e('Save Changes', 'thescene_domain') ?>" /></p>
        </form>
    </div>
    
    <div class="notice notice-info inline"><p><?php printf( esc_attr__( 'After saving credentials, use shortcode %s anywhere to display events from %s', 'thescene_domain' ), '<code><i>[thescene]</i></code>', '<code><i>TheScene.Co</i></code>'); ?></p></div>

    <?php
}

add_action('admin_menu', 'thescene_options_menu_link');