<?php

require_once("dbsupport.php");
require_once("applicationSupport.php");

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $firstName = getFieldValue("firstName", "");
    $lastName = getFieldValue("lastName", "");
    $email = getFieldValue("email", "");
    $phoneNumber = getFieldValue("phoneNumber", "");
    $uid = getFieldValue("uid", "");
    $gpa = getFieldValue("gpa", "");
    $entryYear = getFieldValue("entryYear", "");
    $entrySemester = getFieldValue("entrySemester", "");
    $studentType = getFieldValue("studentType", "");
    $department = getFieldValue("department", "Computer Science");
    $advisor = getFieldValue("advisor", "");
    $currentlyTA = getFieldValue("currentlyTA", "");
    $currentStep = getFieldValue("currentStep", "");
    $currCourse = getFieldValue("currCourse", "");
    $instructor = getFieldValue("instructor", "");
    $experience = getFieldValue("experience", "");
    $isInternational = getFieldValue("isInternational", "");
    $mei = getFieldValue("mei", "");
    $umei = getFieldValue("umei", "");
    $msdegree = getFieldValue("msdegree", "");
    $canTeach = getFieldValue("canTeach", "");
    $prefersTeach = getFieldValue("prefersTeach", "");
    $type = getFieldValue("position", "");
    $year = getFieldValue("year", "");
    $semester = getFieldValue("semester", "");
    $info = getFieldValue("info", "");
    $directoryID = getFieldValue("directoryId", "default");



    // INSERT INTO APPLICANTS TABLE
    $table = "applicants";
    $db_connection = getDBConnection();
    $sqlQuery = "REPLACE INTO `applicants` (`last_name`, `first_name`, `email`, `phone`, `uid`, `gpa`, `entry_semester`,
    `entry_year`, `student_type`, `department`, `advisor`, `is_ta`, `ta_step`, `current_course`, `instructor`, `has_ms`,
    `is_non_us`, `passed_mei`, `taking_umei`, `can_teach`, `prefers_teach`, `position_type`, `semester`, `year`,
     `additional_info`, `directory_id`) VALUES ('$lastName', '$firstName', '$email', '$phoneNumber', '$uid', '$gpa', 
     '$entrySemester', '$entryYear', '$studentType', '$department', '$advisor', '$currentlyTA', '$currentStep', '$currCourse',
     '$instructor', '$msdegree', '$isInternational', '$mei', '$umei', '$canTeach', '$prefersTeach', '$type', '$semester', '$year', '$info', '$directoryID')";
    $result = $db_connection->query($sqlQuery);

    if (!mysqli_query($db_connection, $sqlQuery))
    {
        echo("Errorcode: " . mysqli_error($db_connection));
    }


    mysqli_close($db_connection);


    if ($result) {
        echo "<script>alert('Application Submitted')</script>";
    }
    else{
        echo $result;
        $uploadResult = "<h3>Failed to add document</h3>";
    }

    // INSERT INTO EXPERIENCE TABLE
    $table = "experience";
    $db_connection = getDBConnection();
    $sqlQuery = "DELETE from $table where directory_id = '$directoryID'";
    $result = $db_connection->query($sqlQuery);

    foreach (getFieldValue("experience", []) as $course) {
        $sqlQuery = "INSERT into `$table` (`directory_id`, `course`) VALUES ('$directoryID', '$course')";
        $result = $db_connection->query($sqlQuery);
    }



    // INSERT INTO PREFERENCE TABLE
    $table = "preferred_courses";
    $db_connection = getDBConnection();
    $sqlQuery = "DELETE from $table where directory_id = '$directoryID'";
    $result = $db_connection->query($sqlQuery);

    foreach (getFieldValue("preferredCourses", []) as $course) {
        $sqlQuery = "INSERT into `$table` (`directory_id`, `course`) VALUES ('$directoryID', '$course')";
        $result = $db_connection->query($sqlQuery);
    }

    header("Location: applicantHome.php");


}
else {
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
            <fieldset>
		        <legend>Signature</legend>
                <div class="form-group">
                    <p>
                        By accepting a position as a teaching assistant in the Department of Computer 
                        Science, you agree that you will report to your assigned instructors/professors at least 3 business
                        days before the start of classes and that you will be available at least three days after the last
                        scheduled day of exams.
                    </p>
                    <label class="checkbox-inline"><input type="checkbox" value="" required>I agree</label>
                </div>
                
                <input type="submit" class="btn btn-primary" name="nextPageButton" value="Submit Application"/>&nbsp;
			    <input type="submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu"/>
            </fieldset>
        </form>
             
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 6");
echo $page;


?>