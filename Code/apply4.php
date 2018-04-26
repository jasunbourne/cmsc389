<?php

require_once("bootstrap.php");
require_once("applicationSupport.php");

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["position"] = $_POST["position"];
    $_SESSION["teachingPosition"] = $_POST["teachingPosition"];
    $_SESSION["semester"] = $_POST["semester"];
    $_SESSION["year"] = $_POST["year"];
    $_SESSION["course1"] = $_POST["course1"];
    $_SESSION["course2"] = $_POST["course2"];
    $_SESSION["course3"] = $_POST["course3"];
    $_SESSION["course4"] = $_POST["course4"];
    $_SESSION["course5"] = $_POST["course5"];
    $_SESSION["course5"] = $_POST["course5"];
    $_SESSION["info"] = $_POST["info"];


    header("Location: apply5.php");
}
else {

    $year = getFieldValue("year", "");
    $course1 = getFieldValue("course1", "CMSC");
    $course2 = getFieldValue("course2", "CMSC");
    $course3 = getFieldValue("course3", "CMSC");
    $course4 = getFieldValue("course4", "CMSC");
    $course5 = getFieldValue("course5", "CMSC");
    $info = getFieldValue("info", "");



    $date = date("Y");
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
            <fieldset>
		        <legend>Application Preferences</legend>
                <div class="form-group">
                    <label for="type">Preferred Position Type:</label>
                    <div id="type">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="full" value="1" {$isChecked("position", "1")}>
                            <label class="form-check-label" for="full">Full-time 20hrs/week</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="part" value="2" {$isChecked("position", "2")}>
                            <label class="form-check-label" for="part">Part-time 10hrs/week</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="canTeach">Do you prefer a teaching position?</label>
                    <div id="canTeach">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="teachingPosition" id="yes" value="yes" {$isChecked("teachingPosition", "yes")}>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="teachingPosition" id="cantTeach" value="cantTeach" {$isChecked("teachingPosition", "cantTeach")}>
                            <label class="form-check-label" for="cantTeach">No, I cannot teach</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="teachingPosition" id="noCanTeach" value="noCanTeach" {$isChecked("teachingPosition", "noCanTeach")}>
                            <label class="form-check-label" for="noCanTeach">No, I prefer not to teach</label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <label for="semester">Semester Applying For:</label>
                        <select class="form-control" name="semester" id="semester">
                            <option value = "spring" {$isSelected("semester", "spring")}>Spring</option>
                            <option value = "fall" {$isSelected("semester", "fall")}>Fall</option>
                            <option value = "summer" {$isSelected("semester", "summer")}>Summer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input class="form-control" id="year" type="text" name="year" value=$date>  
                    </div>
                </div>
               
                <div class="form-group">
                    <label>Preferred Courses:</label>
                    <input type="text" name="course1" class="form-control" value="$course1"/><br>
                    <input type="text" name="course2" class="form-control" value="$course2"/><br>
                    <input type="text" name="course3" class="form-control" value="$course3"/><br>
                    <input type="text" name="course4" class="form-control" value="$course4"/><br>
                    <input type="text" name="course5" class="form-control" value="$course5"/><br><br>
                </div>
                                
                <div class="form-group">
                    <label for="info">Additional Info:</label>
                    <textarea class="form-control" rows="5" id="info" name="info">$info</textarea>
                </div>
            </fieldset>
			
			<input type="submit" class="btn btn-primary" name="nextPageButton" value="Next"/>&nbsp;
			<input type = "submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu" formnovalidate/>
		</form>		
BODY;
}

$page = generatePage($contactInfo, "Apply 4");
echo $page;


?>