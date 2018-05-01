<?php
$body = "";

session_start();

require_once("applicationSupport.php");

if (isset($_SERVER['PHP_AUTH_USER'])) {
    $myUser = trim($_SERVER['PHP_AUTH_USER']);
    $myPass = trim($_SERVER['PHP_AUTH_PW']);
}

$file = fopen("admin.txt","r");
    $admin_username = trim(fgets($file));
    $admin_password = trim(fgets($file));
fclose($file);

$myUser = "";
$myPass = "";

if (isset($_SERVER['PHP_AUTH_USER'])) {
    $myUser = trim($_SERVER['PHP_AUTH_USER']);
    $myPass = trim($_SERVER['PHP_AUTH_PW']);
}

if (!($myUser === $admin_username && password_verify($myPass, $admin_password))) {
    header('WWW-Authenticate: Basic realm="Admin"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Not authorized");
}

if (isset($_POST['submitClass'])) {
    $_SESSION['className'] = trim($_POST['className']);
    header("Location: adminChoose.php");
}

if (isset($_POST['viewApps'])) {
    $_SESSION['className'] = trim($_POST['className']);
    header("Location: adminViewApps.php");
}

if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <div class="container">

                <form action="{$_SERVER["PHP_SELF"]}" method="post">
                    <div class="form-group">
                        Enter Class Name:<br><input type="text" name="className" required/>
                    </div>
                    <div class="form-group"> 
                        <input type = "submit" class="btn btn-info" name="submitClass" value = "Assign TA's"/>
                        <input type="submit" class="btn btn-info" name="viewApps" value="View TA Applications" formnovalidate/><br><br>
                        <a class = "btn btn-info" href = "main.php"> Return Home </a>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
BODY;
}

require_once("bootstrap.php");

$page = generatePage($body, "Admin Home");
echo $page;


?>