<?php
$body = "";

if (isset($_POST['appButton'])) {
    header("Location: login.php");
}

if (isset($_POST['adminButton'])) {
    header("Location: adminHome.php");
}

if (isset($_POST['facultyButton'])) {
    header("Location: faculty.php");
}

if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <h1>Login to the CS TA Application Form</h1>

            <div class="container">

                <form action="{$_SERVER["PHP_SELF"]}" method="post">
                    <div class="form-group"> 
                        To apply to be a TA: <input type="submit" class="btn btn-info" name="appButton" value = "Applicants"/>
                    </div>
                    <div class="form-group"> 
                        To view TA applicants: <input type = "submit" class="btn btn-info" name="adminButton" value = "Admin"/>
                    </div>
                    <div class="form-group"> 
                        To access current TA's: <input type = "submit" class="btn btn-info" name="facultyButton" value = "Faculty"/>
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