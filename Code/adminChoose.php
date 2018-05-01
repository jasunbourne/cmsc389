<?php
$body = "";
session_start();

require_once("dbsupport.php");

$table = "course_settings";
$db_connection = getDBConnection();
$course_name = $_SESSION['className'];
$sqlQuery = "select * from $table where course = $course_name";
$result = $db_connection->query($sqlQuery);
if($result){
    $numberOfRows = mysqli_num_rows($result);
    if ($numberOfRows == 0) {
        $sqlQuery2 = "INSERT into course_settings(course, num_ta_teaching, num_ta_grading, chosen_ta_teaching, chosen_ta_grading) VALUES ($course_name, 0,0,0,0)";
        $result2 = $db_connection->query($sqlQuery);
    }
}

if (isset($_POST['changeSettings'])) {
    header("Location: changeSettings.php");
}

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
                        Change Class Settings: <input type="submit" class="btn btn-info" name="changeSettings" value="Go Here"/>
                    </div>
                    <div class="form-group"> 
                        Manually Choose TA: <input type="submit" class="btn btn-info" name="appButton" value="Go Here"/>
                    </div>
                    <div class="form-group"> 
                        Run TA Assignment System: <input type="submit" class="btn btn-info" name="adminButton" value="Go Here"/>
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