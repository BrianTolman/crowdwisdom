<?php

//Template Name: cw-sso-page
/* do the WP Stuff */


try {
    require( './wp-load.php' );
} catch (Exception $e) {
    exit('Require of wp-load.php failed! Error: '.$e);
}
define('WP_USE_THEMES', false); // Don't load theme support functionality
remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop


$current_user = wp_get_current_user();
echo '<pre>';
print_r($current_user);
echo '</pre>';

/*
Timestamp
ClientID
FirstName
LastName
Email
DisplayName
UserName
Password
LastUpdate
Address
City
State
Zip
Country
Phone
Group
*/


$timestamp = time();
$userid = esc_html( $current_user->ID );
$userfirstname = esc_html( $current_user->user_firstname );
$userlastname = esc_html( $current_user->user_lastname );
$useremail = esc_html( $current_user->user_email );
$userdisplayname = esc_html( $current_user->display_name );
$userlogin = esc_html( $current_user->user_login );

// Get the information from the other table

// $sql = 

// so in order as above

echo " <br> $timestamp $userid $userfirstname $userlastname $useremail $userdisplayname $userlogin";







