<?php

//Template Name: cw-sso-page
/* do the WP Stuff */

ini_set('display_errors',1); error_reporting(E_ALL);
try {
    require( './wp-load.php' );
} catch (Exception $e) {
    exit('Require of wp-load.php failed! Error: ' . $e);
}
// require './wp-db.php';

define('WP_USE_THEMES', false); // Don't load theme support functionality
remove_action('genesis_loop', 'genesis_do_loop'); //remove genesis loop


$current_user = wp_get_current_user();
/*
  echo '<pre>';
  print_r($current_user);
  echo '</pre>';
 */

$timestamp = time();
$userid = esc_html($current_user->ID);
$userfirstname = esc_html($current_user->user_firstname);
$userlastname = esc_html($current_user->user_lastname);
$useremail = esc_html($current_user->user_email);
$userdisplayname = esc_html($current_user->display_name);
$userlogin = esc_html($current_user->user_login);

// so in order as above
// echo " <br> $timestamp $userid $userfirstname $userlastname $useremail $userdisplayname $userlogin";
// Get the information from the other table
$dbhost = 'mysql.sandbox.sages.org';
$dbuser = 'sandboxsagesorg';
$dbpassword = '^cyFD85g';
$dbname = 'sandbox_sages_org';

if ($link = mysqli_connect("$dbhost", "$dbuser", "$dbpassword", "$dbname")) {
    // echo "connected <br>";
} else {
    echo "not connected";
}

$usersql = 'SELECT * FROM `sagesmembers` WHERE `EMAIL` = "' . "artinyan@bcm.edu" . '"';
if ($result = mysqli_query($link, $usersql)) {
    $rowcount = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    // echo '<pre>';
    // print_r($row) . "<br>";
    // echo '</pre>';
    // Gather the info about the user.
    echo "[SEQNUMB] $row[SEQNUMB] <br>";
    $userid = $row[SEQNUMB];
    echo "[FNAME] $row[FNAME] <br>";
    echo "[MIDINITIAL] $row[MIDINITIAL] <br>";
    echo "[LNAME] $row[LNAME] <br>";
    echo "[LNAMEPLUS] $row[LNAMEPLUS] <br>";
    echo "[TITLE_DEPT] $row[TITLE_DEPT] <br>";
    echo "[HOSPITAL] $row[HOSPITAL] <br>";
    echo "[ADDRESS1] $row[ADDRESS1] <br>";
    echo "[ADDRESS2] $row[ADDRESS2] <br>";
    echo "[CITY] $row[CITY] <br>";
    echo "[STATE] $row[STATE] <br>";
    echo "[ZIPCODE] $row[ZIPCODE] <br>";
    echo "[COUNTRY] $row[COUNTRY] <br>";
    echo "[PHONE] $row[PHONE] <br>";
    echo "[FAX] $row[FAX] <br>";
    echo "[EMAIL] $row[EMAIL] <br>";
    echo "[CATEGORY] $row[CATEGORY] <br>";
    echo "[MemberStatus] $row[MemberStatus] <br>";
    echo "[TOTAL_DUE] $row[TOTAL_DUE] <br>";
    echo "[CHANGED] $row[CHANGED] <br>";
    echo "[MEMBERDATE] $row[MEMBERDATE] <br>";
    echo "[PASSWORD] $row[PASSWORD] <br>";
    echo "[PASSWORDMD5] $row[PASSWORDMD5] <br>";
    echo "[LOOKUP] $row[LOOKUP] <br>";
    echo "[AsstName] $row[AsstName] <br>";
    echo "[AsstEmail] $row[AsstEmail] <br>";
    echo "[CellPhone] $row[CellPhone] <br>";
}


if ($wpuserdata = get_userdata($userid)) {
    echo '<pre>';
    print_r($wpuserdata) . "<br>";
    echo '</pre>';
} else {
    echo "Did not retrieve. <br>";
    
}

/* encrypt this */
$triple_des_key = 'ABCDEFGHIJKLMNOPQRSTUVWX'; // <!-- 24char 3DES Key
$username_string = 'username=<username here>'; // Encrypt this string

if ($triple_des_key) {
    echo "<br>Encoded : ";
    $encoded1 = (mcrypt_encrypt(MCRYPT_3DES, $triple_des_key, $username_string, ecb));
    $encoded = (base64_encode(mcrypt_encrypt(MCRYPT_3DES, $triple_des_key, $username_string, ecb)));

    if (!$encoded) {
        echo "encoded is empty";
    } else {
        echo $encoded . "<br>";
    }
} else {
    echo "<br>>failed.";
}



// <-- Output
// print_r($encrypted_username);
?>