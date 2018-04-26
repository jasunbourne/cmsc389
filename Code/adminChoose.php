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
                        Manually Choose TAs: <input type = "submit" class="btn btn-info" name="appButton" value = "Manually Choose TA Assignment"/>
                    </div>
                    <div class="form-group"> 
                        Run TA Assignment System: <input type = "submit" class="btn btn-info" name="adminButton" value = "Run TA Assignment"/>
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


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>