<?php
$body = "";
session_start();

if (isset($_POST['appButton'])) {
    header("Location: manualTA.php");
}

if (isset($_POST['adminButton'])) {
    header("Location: automaticTA.php");
}

if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <h1>Login to the CS TA Application Form</h1>

            <div class="container">

                <form action="{$_SERVER["PHP_SELF"]}" method="post">
                    <div class="form-group"> 
                        Manually Choose TAs: <input type="submit" class="btn btn-info" name="appButton" value="Manually Choose TA Assignment"/>
                    </div>
                    <div class="form-group"> 
                        Run TA Assignment System: <input type="submit" class="btn btn-info" name="adminButton" value="Run TA Assignment"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
BODY;
}

require_once("bootstrap.php");

$page = generatePage($body, "Main");
echo $page;


?>