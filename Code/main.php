<?php
$body = "";

if (isset($_POST['appButton'])) {
    header("Location: applicantHome.php");
}

if (isset($_POST['adminButton'])) {
    header("Location: adminChoose.php");
}

if (isset($_POST['facultyButton'])) {
    header("Location: faculty.php");
}

if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="page-header" style="background-color: red;">
            <img style="margin-top:15px; margin-left:10px;" src="https://upload.wikimedia.org/wikipedia/en/3/3e/University_of_Maryland_seal.svg" alt="UMD Logo" height="70" width="70">
            <img style="margin-top:15px; margin-left:10px;" src="http://s3.amazonaws.com/umdheader.umd.edu/app/images/umd-bar-logo.png" alt="toggle">
            <hr>
        </div>   
        <div class="container">
            <h1>Login to the CS TA Application Form</h1>

            <div class="container">

                <form action="main.php" method="post">
                    <div class="form-group"> 
                        To apply to be a TA: <input type = "submit" class="btn btn-info" name="appButton" value = "Applicants"/>
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