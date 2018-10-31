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
//print_r($current_user);
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

/*
 * @example Safe usage: $current_user = wp_get_current_user();
 * if ( ! ( $current_user instanceof WP_User ) ) {
 *     return;
 * }
 */
printf( __( 'Username: %s', 'textdomain' ), esc_html( $current_user->user_login ) );
echo '<br />';
printf( __( 'User email: %s', 'textdomain' ), esc_html( $current_user->user_email ) );
echo '<br />';
printf( __( 'User first name: %s', 'textdomain' ), esc_html( $current_user->user_firstname ) );
echo '<br />';
printf( __( 'User last name: %s', 'textdomain' ), esc_html( $current_user->user_lastname ) );
echo '<br />';
printf( __( 'User display name: %s', 'textdomain' ), esc_html( $current_user->display_name ) );
echo '<br />';
printf( __( 'User ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );

// prepare parameters to be passed to the gateway 
// params-output("clientId", "123); 
 
