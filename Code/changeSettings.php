<?php
$body = "";

require_once("dbsupport.php");
require_once("applicationSupport.php");

session_start();
$teaching_ta = 0;
$grading_ta = 0;
$course_name = $_SESSION['className'];
$course_name = strtoupper($course_name);

$table = "course_settings";
$db_connection = getDBConnection();
$sqlQuery = "select * from '$table' where course like '$course_name'";
$result = $db_connection->query($sqlQuery);
if ($result) {
    echo "YEAH";
    $numberOfRows = mysqli_num_rows($result);
    while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $teaching_ta = $recordArray['num_ta_teaching'];
        $grading = $recordArray['num_ta_grading'];
    }
}

if (isset($_POST['changeSettings'])) {
    $update_teaching = $_POST['teaching'];
    $update_grading = $_POST['grading'];
    $sqlQuery = "UPDATE $table set num_ta_teaching = $update_teaching, num_ta_grading = $update_grading where course like '$course_name'";
    $result = $db_connection->query($sqlQuery);
    header("Location: adminChoose.php");
}

if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <div class="container">
                <h2>Settings for {$course_name}</h2>
                    <form action="{$_SERVER["PHP_SELF"]}" method="post">
                        <div class="form-group">
                            Number of Teaching TA In Class: <input type="number" value="{$teaching_ta}" min="0" max="20" name="teaching" />
                        </div>
                        <div class="form-group">
                            Number of Grading TA In Class: <input type="number" value="{$grading_ta}" min="0" max="20" name="grading" />
                        </div>
                    <div class="form-group"> 
                        <input type = "submit" class="btn btn-info" name="changeSettings" value = "Accept Changes"/>
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