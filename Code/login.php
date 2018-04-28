<?php
session_start();
$body = "";
$bottomPart = "";
$msg = "";
if (isset($_POST['submitBtn'])) {
    $login_nm = $_POST["directoryid"];
    $login_passwd = $_POST["password"];
    /* Establish a connection to the LDAP server */
    $ldapconn=ldap_connect("ldap://ldap.umd.edu/",389) or die('Could not connect<br>');
    // $ldapconn=ldap_connect("ldaps://ldap.umd.edu/",389) or die('Could not connect<br>');
    /* Set the protocol version to 3 (unless set to 3 by default) */
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    /* Bind user to LDAP with password */
    $verify_user=@ldap_bind($ldapconn,"uid=$login_nm,ou=people,dc=umd,dc=edu",$login_passwd);
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
            $msg = "You do not have valid credentials<br>";
        }

        $_SESSION["directoryId"] = $info[0]["uid"][0];
        //echo '<pre>';
        //var_dump($info);
        //echo '</pre>';
    } else {
        $msg = "Invalid email address / password <br><br>";
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
                <div id="error">
                    {$msg}
                </div>   
                <div class="form-group">
                    <input type="reset" class="btn btn-primary"/>
                    <input type="submit" name="submitBtn" value="Continue" class="btn btn-primary"/>
                </div>
            </form>
      </div>
BODY;
}
require_once("bootstrap.php");
$page = generatePage($body.$bottomPart, "Login");
echo $page;
?>