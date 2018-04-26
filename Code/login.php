<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <title>Main Menu</title>
</head>
<body>


<?php

session_start();

$body = "";
$bottomPart = "";

if (isset($_POST['submitBtn'])) {
    $login_nm = $_POST["directoryid"];
    $login_passwd = $_POST["password"];

    /* Establish a connection to the LDAP server */
    $ldapconn=ldap_connect("ldap://ldap.umd.edu/",389) or die('Could not connect<br>');
    // $ldapconn=ldap_connect("ldaps://ldap.umd.edu/",389) or die('Could not connect<br>');

    /* Set the protocol version to 3 (unless set to 3 by default) */
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

    /* Bind user to LDAP with password */
    $verify_user=ldap_bind($ldapconn,"uid=$login_nm,ou=people,dc=umd,dc=edu",$login_passwd);

    if ($verify_user) {
        $filter="(uid=$login_nm)";
        $result = ldap_search($ldapconn,"dc=umd,dc=edu",$filter);
        ldap_sort($ldapconn,$result,"sn");
        $info = ldap_get_entries($ldapconn, $result);
        //echo "<p>You are accessing <strong> ". $info[0]["umstaff"][0] .", " . $info[0]["givenname"][0] ."</strong><br /> (" . $info[0]["uid"][0] .")</p>\n";
        $_SESSION["person"] = $info;
        if ($info[0]["umstaff"][0] === "TRUE") {
            header("Location: main.php");
        }
        else if ($info[0]["umstudent"][0] === "TRUE") {
            header("Location: applicantHome.php");
        }
        else {
            $msg = "You do not have valid credentials";
            echo $msg;
        }
        //echo '<pre>';
        //var_dump($info);
        //echo '</pre>';

    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }

    // Release connection
    ldap_unbind($ldapconn);
}

if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <h1>Student Application Section</h1>
            <form action="{$_SERVER["PHP_SELF"]}" method="post">
                <div class="form-group">
                    <strong>DirectoryID: </strong><input type="text" name = "directoryid" />
                </div>
                <div class="form-group">
                    <strong>Password: </strong><input type="password" name="password" />
                </div>       

                <div class="form-group">
                    <input type="reset" />
                    <input type="submit" name="submitBtn" value="Continue" />
                </div>
            </form>
      </div>
BODY;
}

echo $body.$bottomPart;

?>


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>