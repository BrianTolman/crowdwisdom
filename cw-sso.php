<?php

//Template Name: cw-sso-page
/* do the WP Stuff */
echo "hi";
require( './wp-load.php' );
define('WP_USE_THEMES', false); // Don't load theme support functionality
//remove_action('genesis_loop', 'genesis_do_loop');//remove genesis loop


/*
 * Validate the user.
 */
wp_get_current_user();


get_currentuserinfo();

if ('' == $user_ID) {
    echo "<br>No User logged in.";
    echo "<br>User must be logged in to use this page.";
    break;
} else {
    echo "You are logged in.<br>";
    // get_currentuserinfo();
    // echo $display_name . "'s email address is: " . $user_email . "whose level is " . $user_level . "<br>";
}

/*
 * db information
 */
$servername = "mysql.sandbox.sages.org";
$username = "sandboxsagesorg";
$password = "^cyFD85g";
$dbname = "sandbox_sages_org";
if ($link = mysqli_connect("$servername", "$username", "$password", "$dbname")) {
    echo "connected <br>";
}

// Get the user information

$current_user = wp_get_current_user();
 
/*
 * @example Safe usage: $current_user = wp_get_current_user();
 * if ( ! ( $current_user instanceof WP_User ) ) {
 *     return;
 * }
 */
printf( __( 'Username: %s', 'textdomain' ), esc_html( $current_user->user_login ) ) . '<br />';
printf( __( 'User email: %s', 'textdomain' ), esc_html( $current_user->user_email ) ) . '<br />';
printf( __( 'User first name: %s', 'textdomain' ), esc_html( $current_user->user_firstname ) ) . '<br />';
printf( __( 'User last name: %s', 'textdomain' ), esc_html( $current_user->user_lastname ) ) . '<br />';
printf( __( 'User display name: %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
printf( __( 'User ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );