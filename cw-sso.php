<?php
//Template Name: cw-sso-page
/* load all the needed WP Stuff and set the options.
 * load wp-load stuff
 */
try {
    require( './wp-load.php' );
} catch (Exception $e) {
    exit('Require of wp-load.php failed! Error: ' . $e);
}
// don't load the themes
try {
    define('WP_USE_THEMES', false); // Don't load theme support functionality
} catch (Exception $e) {
    exit('Use of Themes somehow failed! Error: ' . $e);
}
// don't load the genesis loop
try {
    remove_action('genesis_loop', 'genesis_do_loop'); //remove genesis loop
} catch (Exception $e) {
    exit('Genesis Loop not removed! Error: ' . $e);
}
/* end of wp loading */
// Test for mcrypt
if (function_exists('mcrypt_encrypt')) {
    echo "mcrypt exists";
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
        // echo "connected";
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
                echo "User is $useremail is a SAGES site member, but is not a member of Sages.<br>";
                exit('You need to be a member to use this.');
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
        ?>
        <h1>Debugging Information</h1>
        <p> Email is: <?php echo $Email; ?> </p>
        <p> Password is : <?php echo $Password; ?> </p>
        <hr>
        <?php
        // Create the URL
        $rawData = "Timestamp=$timestamp&ClientID=$ClientID&FirstName=$FirstName&LastName=$LastName&Email=$Email&DisplayName=$DisplayName&UserName=$UserName&Password=$Password&Address=$Address&City=$City&State=$State&Zip=$Zip&Country=$Country&Phone=$Phone&Group=$Group";
        echo "1. Raw data : $rawData <br><br>";
        /* encrypt raw data */
        /* Encryption Variables 
         * these are from Crowd Wisdom
         */
        $encryptionMethod = "des-ede3-cbc";
        $secretHash = "ng6FYeXfSvcTH8IIx7M79P7HqHrEjDEQ";
        $iv = "jlIk1cshdrU = ";
        // Encrypt the data
        $encryptedData = openssl_encrypt($rawData, $encryptionMethod, $secretHash, 0, $iv);
        echo "2a. encrypted data : $encryptedData <br><br>";
        // Encrypt and store in base64
        $encryptedData64 = base64_encode(openssl_encrypt($rawData, $encryptionMethod, $secretHash, 0, $iv));
        echo "2b. base 64 encapsulated encrypted data : $encryptedData64 <br><br>";


        if (!$encryptedData) {
            echo "raw data was empty";
        } else {
            // urlencode it
            $rawurlencodedData = rawurlencode($encryptedData);
            echo "3a. rawurlencode : $rawurlencodedData <br><br>";
            $urlencodedData = urlencode($encryptedData);
            echo "3b. urlencode : $urlencodedData <br><br>";
            // url with base 64
            $rawurlencodedData64 = rawurlencode($encryptedData64);
            echo "3c. base 64 rawurlencode : $rawurlencodedData64 <br><br>";
            $urlencodedData64 = urlencode($encryptedData64);
            echo "3d. base 64 urlencode : $urlencodedData64 <br><br>";
            
        }
        // create the url
        echo "<h2>The URL's</h2>";
        // raw encoded url
        echo "<hr><br>Raw Encoding ";
        $crowdwisdomURLRAW = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $rawurlencodedData . '"';
        echo '4a. <a href="' . $crowdwisdomURLRAW . '"> The URL using raw encoding is : ' . $crowdwisdomURLRAW . "</a>";
        // regular encoded url
        echo "<hr><br>Regular Encoding ";
        $crowdwisdomURL = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $urlencodedData . '"';
        echo '4b. <a href="' . $crowdwisdomURL . '"> The URL using regular encoding is : ' . $crowdwisdomURL . "</a>";
        // raw encoded url base 64
        echo "<hr><br>Raw Encoding base 64 ";
        $crowdwisdomURLRAW64 = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $rawurlencodedData64 . '"';
        echo '4c. <a href="' . $crowdwisdomURLRAW64 . '"> The URL using raw encoding and base 64 is : ' . $crowdwisdomURLRAW64 . "</a>";
        // regular encoded base 64
        echo "<hr><br>Regular Encoding base 64 ";
        $crowdwisdomURL64 = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $urlencodedData64 . '"';
        echo '4d. <a href="' . $crowdwisdomURL64 . '"> The URL using regular encoding and base 64 is : ' . $crowdwisdomURL64 . "</a>";
        // Unencoded url
        echo "<hr><br>Unencoded ";
        $crowdwisdomURLNothing = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $encryptedData . '"';
        echo '4c. <a href="' . $crowdwisdomURLNothing . '"> The URL without encoding is : ' . $crowdwisdomURLNothing . "</a>";
        // Unencoded base 64 url
        echo "<hr><br>Unencoded Base 64";
        $crowdwisdomURLNothing64 = "https://sages.precrowdwisdom.com/diweb/gateway/?data=" . $encryptedData64 . '"';
        echo '4D. <a href="' . $crowdwisdomURLNothing64 . '"> The URL without encoding is : ' . $crowdwisdomURLNothing64 . "</a>";
        // echo '<script type="text/javascript" language="javascript"> window.open("' . $crowdwisdomURL . '");</script>';
    } else {
        echo "Unable to connect to the database";
    }
}
