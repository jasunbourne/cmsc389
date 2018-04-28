<?php
$body = "";

if (isset($_POST['submitClass'])) {
    session_start();
    $_SESSION['className'] = $_POST['className'];
    header("Location: manualTA.php");
}


if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <h1>Enter Class Name</h1>

            <div class="container">

                <form action="main.php" method="post">
                    <div class="form-group">
                        <input type="text" name="className" required/>
                    </div>
                    <div class="form-group"> 
                        Manually Choose TAs: <input type = "submit" class="btn btn-info" name="appButton" value = "Manually Choose TA Assignment"/>
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