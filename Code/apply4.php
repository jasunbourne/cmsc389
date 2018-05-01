<?php

require_once("bootstrap.php");
require_once("applicationSupport.php");

session_start();

$contactInfo = "";

$isGrad = getFieldValue("studentType", "") != "ugrad";
$courseCount = $isGrad ? 5 : 3;

function createCourseOptionList($courses){
    $result = "";
    foreach($courses as $course){
        $isSelected = isSelectedMulti("preferredCourses", $course);
        $result.= "<option value='$course' $isSelected>$course</option>\n";
    }
    return $result;
}

if(isset($_POST["prevPageButton"]))
    header("Location: apply3.php");

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["position"] = $_POST["position"];
    $_SESSION["canTeach"] = $_POST["canTeach"];
    $_SESSION["prefersTeach"] = $_POST["prefersTeach"];
    $_SESSION["semester"] = $_POST["semester"];
    $_SESSION["year"] = $_POST["year"];
    $_SESSION["preferredCourses"] = $_POST["preferredCourses"];
    $_SESSION["info"] = $_POST["info"];

    header("Location: apply5.php");
}
else {

    $year = getFieldValue("year", "");
    $info = getFieldValue("info", "");

    $courses = createCourseOptionList(["CMSC131", "CMSC132", "CMSC216", "CMSC250", "CMSC330", "CMSC351", "Other"]);

    $date = date("Y");
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
            <fieldset>
		        <legend>Application Preferences</legend>
                <div class="form-group">
                    <label for="type">Preferred Position Type:</label>
                    <div id="type">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="full" value="fulltime" {$isChecked("position", "fulltime")} required>
                            <label class="form-check-label" for="full">Full-time 20hrs/week</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="part" value="parttime" {$isChecked("position", "parttime")}>
                            <label class="form-check-label" for="part">Part-time 10hrs/week</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="canTeach">Do you prefer a teaching position?</label>
                    <div id="canTeach">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="canTeach" id="1" value="1" {$isChecked("canTeach", "1")} required>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="canTeach" id="0" value="0" {$isChecked("canTeach", "0")}>
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="prefersTeach">Can you teach?</label>
                    <div id="prefersTeach">
                         <div class="form-check">
                            <input class="form-check-input" type="radio" name="prefersTeach" id="1" value="1" {$isChecked("prefersTeach", "1")} required>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prefersTeach" id="0" value="0" {$isChecked("prefersTeach", "0")}>
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <label for="semester">Semester Applying For:</label>
                        <select class="form-control" name="semester" id="semester" required>
                            <option value = "spring" {$isSelected("semester", "spring")}>Spring</option>
                            <option value = "fall" {$isSelected("semester", "fall")}>Fall</option>
                            <option value = "summer" {$isSelected("semester", "summer")}>Summer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input class="form-control" id="year" type="text" name="year" value=$date required>  
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="preferredCourses">Select the courses you would be interested in being a TA for (max $courseCount): </label>
                    <select class="form-control" name="preferredCourses[]" id="preferredCourses" multiple required>
                        $courses
                    </select>
                </div>
                                
                <div class="form-group">
                    <label for="info">Additional Info:</label>
                    <textarea class="form-control" rows="5" id="info" name="info">$info</textarea>
                </div>
            </fieldset>
			<input class="btn btn-primary" type="submit" name="prevPageButton" value="Previous" formnovalidate/>
			<input type="submit" class="btn btn-primary" name="nextPageButton" value="Next"/>&nbsp;
			<input type = "submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu" formnovalidate/>
		</form>		
BODY;
}

$page = generatePage($contactInfo, "Apply 4");
echo $page;


echo <<<SCRIPT
<script>
    $(document).ready(function() {
        var last_valid_selection = null;
        $('#preferredCourses').change(function(event) {

            if ($(this).val().length > $courseCount) {
                $(this).val(last_valid_selection);
                alert("Too many courses selected")
            } else {
                last_valid_selection = $(this).val();
            }
        });
    });
</script>
SCRIPT;


?>