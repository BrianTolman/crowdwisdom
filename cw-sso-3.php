<?php

//Template Name: cw-sso-page
/* load all the needed WP Stuff and set the options. */

// Error settings
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// load wp-load
try {
    require( './wp-load.php' );
//echo "Errors wp-load loaded.<br>";
} catch (Exception $e) {
    exit('Require of wp-load.php failed! Error: ' . $e);
}

// don't load the themes
try {
    define('WP_USE_THEMES', false); // Don't load theme support functionality
//echo "Themes set off.<br>";
} catch (Exception $e) {
    exit('Use of Themes somehow failed! Error: ' . $e);
}

// don't load the genesis loop
try {
    remove_action('genesis_loop', 'genesis_do_loop'); //remove genesis loop
//echo "Genesis Loop removed.<br>";
} catch (Exception $e) {
    exit('Genesis Loop not removed! Error: ' . $e);
}
// Get the current user and test for being logged in
$current_user = wp_get_current_user();
if ($current_user->ID == '') {
//show nothing to user if they are not logged in
    exit('You need to log in');
} else {

// Connect to the db
    $dbhost = 'mysql.sandbox.sages.org';
    $dbuser = 'sandboxsagesorg';
    $dbpassword = '^cyFD85g';
    $dbname = 'sandbox_sages_org';

    if ($link = mysqli_connect("$dbhost", "$dbuser", "$dbpassword", "$dbname")) {
        
    } else {
        echo "not connected";
    }

// Get the timestamp
    $timestamp = time();

// Get the Current User Information
    $current_user = wp_get_current_user();

//load up the variables needed from the WP user db
    $useremail = esc_html($current_user->user_email);
    $useridwp = esc_html($current_user->ID);
    $userfirstname = esc_html($current_user->user_firstname);
    $userlastname = esc_html($current_user->user_lastname);
    $DisplayName = esc_html($current_user->display_name);
    $UserName = esc_html($current_user->user_login);

// sql to find the user
    $usersql = 'SELECT * FROM `sagesmembers` WHERE `EMAIL` = "' . esc_html($current_user->user_email) . '"';

    if ($result = mysqli_query($link, $usersql)) {
        $rowcount = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($rowcount == 0) {
            exit('You need to be a member');
        }

// Gather the info about the user from the member db.

        $userid = $row[SEQNUMB];
        $ClientID = $row[SEQNUMB];
        $FirstName = $row[FNAME];
        $LastName = $row[LNAME];
        $Group = $row[HOSPITAL];
// if there is an address 2, use it.
        if ($row[ADDRESS2] != "") {
            $Address = $row[ADDRESS1] . " " . $row[ADDRESS2];
        } else {
            $Address = $row[ADDRESS1];
        }
        $City = $row[CITY];
        $State = $row[STATE];
        $Zip = $row[ZIPCODE];
        $Country = $row[COUNTRY];
        $Phone = $row[PHONE];
        $Email = $row[EMAIL];
        $Password = $row[PASSWORD]; // yeah, the password is stored in clear text here.
    }

// Create the URL

    $data = "Timestamp=$timestamp&ClientID=$ClientID&FirstName=$FirstName&LastName=$LastName&Email=$Email&DisplayName=$DisplayName&UserName=$UserName&Password=$Password&Address=$Address&City=$City&State=$State&Zip=$Zip&Country=$Country&Phone=$Phone&Group=$Group";
    echo "This is the raw data";
    echo "data=$data<br>";

    /* encrypt this */
    $encryptionMethod = "des-ede3-cbc";
    $secretHash = "ng6FYeXfSvcTH8IIx7M79P7HqHrEjDEQ";
    $iv = "jlIk1cshdrU=";

//Template Name: cw-sso-page
    /* load all the needed WP Stuff and set the options. */

// Error settings
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
// load wp-load
    try {
        require( './wp-load.php' );
//echo "Errors wp-load loaded.<br>";
    } catch (Exception $e) {
        exit('Require of wp-load.php failed! Error: ' . $e);
    }

// don't load the themes
    try {
        define('WP_USE_THEMES', false); // Don't load theme support functionality
//echo  "Themes set off.<br>";
    } catch (Exception $e) {
        exit('Use of Themes somehow failed! Error: ' . $e);
    }

// don't load the genesis loop
    try {
        remove_action('genesis_loop', 'genesis_do_loop'); //remove genesis loop
//echo  "Genesis Loop removed.<br>";
    } catch (Exception $e) {
        exit('Genesis Loop not removed! Error: ' . $e);
    }
// Get the current user and test for being logged in
    $current_user = wp_get_current_user();
    if ($current_user->ID == '') {
//show nothing to user if they are not logged in
        exit('You need to log in');
    } else {

        // Connect to the db
        $dbhost = 'mysql.sandbox.sages.org';
        $dbuser = 'sandboxsagesorg';
        $dbpassword = '^cyFD85g';
        $dbname = 'sandbox_sages_org';

        if ($link = mysqli_connect("$dbhost ", "$dbuser ", "$dbpassword ", "$dbname")) {
            
        } else {
            echo "not connected";
        }

        // Get the timestamp
        $timestamp = time();

        // Get the Current User Information
        $current_user = wp_get_current_user();

        //load up the variables needed from the WP user db
        $useremail = esc_html($current_user->user_email);
        $useridwp = esc_html($current_user->ID);
        $userfirstname = esc_html($current_user->user_firstname);
        $userlastname = esc_html($current_user->user_lastname);
        $DisplayName = esc_html($current_user->display_name);
        $UserName = esc_html($current_user->user_login);

        // sql to find the user
        $usersql = 'SELECT * FROM `sagesmembers` WHERE `EMAIL` = "' . esc_html($current_user->user_email) . '"';

        if ($result = mysqli_query($link, $usersql)) {
            $rowcount = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if ($rowcount == 0) {
                exit('You need to be a member');
            }

// Gather the info about the user from the member db.

            $userid = $row[SEQNUMB];
            $ClientID = $row[SEQNUMB];
            $FirstName = $row[FNAME];
            $LastName = $row[LNAME];
            $Group = $row[HOSPITAL];
            // if there is an address 2, use it.
            if ($row[ADDRESS2] != "") {
                $Address = $row[ADDRESS1] . " " . $row[ADDRESS2];
            } else {
                $Address = $row[ADDRESS1];
            }
            $City = $row[CITY];
            $State = $row[STATE];
            $Zip = $row[ZIPCODE];
            $Country = $row[COUNTRY];
            $Phone = $row[PHONE];
            $Email = $row[EMAIL];
            $Password = $row[PASSWORD]; // yeah, the password is stored in clear text here.
        }

        // Create the URL

        $data = "Timestamp = $timestamp&ClientID = $ClientID&FirstName = $FirstName&LastName = $LastName&Email = $Email&DisplayName = $DisplayName&UserName = $UserName&Password = $Password&Address = $Address&City = $City&State = $State&Zip = $Zip&Country = $Country&Phone = $Phone&Group = $Group";
        // echo "data = $data<br>";

        /* encrypt this */
        $encryptionMethod = "des-ede3-cbc";
        $secretHash = "ng6FYeXfSvcTH8IIx7M79P7HqHrEjDEQ";
        $iv = "jlIk1cshdrU = ";
        $encryptedData = openssl_encrypt($data, $encryptionMethod, $secretHash, 0, $iv);

        if (!$encryptedData) {
            echo "encoded is empty";
        } else {
            $data_string = $encryptedData; // Encrypted data
            //echo $data_string . "<br>";
        }

        //Send them off ..
        // the url
        $crowdwisdomURL = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $data_string . '"';
// echo '<script type="text/javascript" language="javascript"> window.open("' . $crowdwisdomURL . '");</script>';
        echo $crowdwisdomURL;



        /*
         * This is the decryption test or debugging section
         * 
          if (1 == 1) {

          echo "<br>Encoded : ";
          $encryptedData = openssl_encrypt($data_string, $encryptionMethod, $secretHash, 0, $iv);
          if (!$encryptedData) {
          echo "encoded is empty";
          } else {
          echo $encryptedData . "<br>";
          $decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash, 0, $iv);
          echo "<br>Decrypted it is: " . $decryptedMessage;
          }
          } else {
          echo "<br>>failed.";
          }
         * 
         */
    }

    $encryptedData = openssl_encrypt($data, $encryptionMethod, $secretHash, 0, $iv);

    if (!$encryptedData) {
        echo "encoded is empty";
    } else {
        $data_string_raw = $encryptedData; // Encrypted data
        //echo $data_string . "<br>";
        // urlencode it
        $data_string = urlencode($data_string_raw);
    }

//Send them off ..
    echo "the url<br>";
    $crowdwisdomURL = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $data_string . '"';
    echo "the url<br>";
// echo '<script type="text/javascript" language="javascript"> window.open("' . $crowdwisdomURL . '");</script>';
    echo $crowdwisdomURL;



    /*
     * This is the decryption test or debugging section
     * 
      if (1 == 1) {

      echo "<br>Encoded : ";
      $encryptedData = openssl_encrypt($data_string, $encryptionMethod, $secretHash, 0, $iv);
      if (!$encryptedData) {
      echo "encoded is empty";
      } else {
      echo $encryptedData . "<br>";
      $decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash, 0, $iv);
      echo "<br>Decrypted it is: " . $decryptedMessage;
      }
      } else {
      echo "<br>>failed.";
      }
     * 
     */
}
