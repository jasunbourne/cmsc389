<?php

require_once("dbsupport.php");
require_once("applicationSupport.php");

session_start();

$directoryID = getFieldValue("directoryId", "default");

$db_connection = getDBConnection();

$sqlQuery = "SELECT * FROM `applicants` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["firstName"] = $recordArray["first_name"];
        $_SESSION["lastName"] = $recordArray["last_name"];
        $_SESSION["email"] = $recordArray["email"];
        $_SESSION["phoneNumber"] = $recordArray["phone"];
        $_SESSION["uid"] = $recordArray["uid"];
        $_SESSION["gpa"] = $recordArray["gpa"];
        $_SESSION["entrySemester"] = $recordArray["entry_semester"];
        $_SESSION["entryYear"] = $recordArray["entry_year"];
        $_SESSION["studentType"] = $recordArray["student_type"];
        $_SESSION["department"] = $recordArray["department"];
        $_SESSION["advisor"] = $recordArray["advisor"];
        $_SESSION["currentlyTA"] = $recordArray["is_ta"];
        $_SESSION["currentStep"] = $recordArray["ta_step"];
        $_SESSION["currCourse"] = $recordArray["current_course"];
        $_SESSION["instructor"] = $recordArray["instructor"];
        $_SESSION["msdegree"] = $recordArray["has_ms"];
        $_SESSION["isInternational"] = $recordArray["is_non_us"];
        $_SESSION["mei"] = $recordArray["passed_mei"];
        $_SESSION["umei"] = $recordArray["taking_umei"];
        $_SESSION["position"] = $recordArray["position_type"];
        $_SESSION["canTeach"] = $recordArray["can_teach"];
        $_SESSION["prefersTeach"] = $recordArray["prefers_teach"];
        $_SESSION["semester"] = $recordArray["semester"];
        $_SESSION["year"] = $recordArray["year"];
        $_SESSION["info"] = $recordArray["additional_info"];
    }
    mysqli_free_result($result);
} else {
    $body = "<h3>Failed to retrieve document existing transcript ".mysqli_error($db)." </h3>";
}

$sqlQuery = "SELECT * FROM `experience` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if ($result) {
    $results = [];

    while ($recordArray = mysqli_fetch_assoc($result)) {
        if (mysqli_num_rows($result) > 0) {
            array_push($results, $recordArray["course"]);
        }
    }
    $_SESSION["experience"] = $results;
    mysqli_free_result($result);
} else {
    $body = "<h3>Failed to retrieve document existing transcript ".mysqli_error($db)." </h3>";
}

$sqlQuery = "SELECT * FROM `preferred_courses` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if ($result) {
    $results = [];
    while ($recordArray = mysqli_fetch_assoc($result)) {
        if (mysqli_num_rows($result) > 0) {
            array_push($results, $recordArray["course"]);
        }
    }
    $_SESSION["preferredCourses"] = $results;
    mysqli_free_result($result);
} else {
    $body = "<h3>Failed to retrieve document existing transcript ".mysqli_error($db)." </h3>";
}


mysqli_close($db_connection);

$body = <<<BODY
    <h1>TA Application</h1>
    <a class="btn btn-primary" href="apply1.php">Apply/Edit Application</a>
    <a class="btn btn-primary" href="deleteApplication.php">Remove Application</a>

BODY;

require_once("bootstrap.php");

$page = generatePage($body, "Applicant Home");
echo $page;
?>