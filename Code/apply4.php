<?php

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["position"] = $_POST["position"];
    $_SESSION["semester"] = $_POST["semester"];
    $_SESSION["year"] = $_POST["year"];
    $_SESSION["course1"] = $_POST["course1"];
    $_SESSION["course2"] = $_POST["course2"];
    $_SESSION["course3"] = $_POST["course3"];
    $_SESSION["course4"] = $_POST["course4"];
    $_SESSION["course5"] = $_POST["course5"];

    header("Location: main.php");

}
else {
    $date = date("Y");
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
            <fieldset>
		        <legend>Application Preferences</legend>
                <div class="form-group">
                    <label for="type">Preferred Position Type:</label>
                    <div id="type">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="full" value="1">
                            <label class="form-check-label" for="full">Full-time 20hrs/week</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position" id="part" value="2">
                            <label class="form-check-label" for="part">Part-time 10hrs/week</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="prefersTeaching">Do you prefer a teaching position?</label>
                    <div id="prefersTeaching">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="teachingPosition" id="yes" value="yes">
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="teachingPosition" id="no" value="no">
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <label for="semester">Semester Applying For:</label>
                        <select class="form-control" name="semester" id="semester">
                            <option value = "spring">Spring</option>
                            <option value = "fall">Fall</option>
                            <option value = "summer">Summer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input class="form-control" id="year" type="text" name="year" value=$date>  
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="courses">Preferred Courses:</label>
                    <input id="courses" type="text" name="course1" value="CMSC" class="form-control"/><br>
                    <input type="text" name="course2" value="CMSC" class="form-control"/><br>
                    <input type="text" name="course3" value="CMSC" class="form-control"/><br>
                    <input type="text" name="course4" value="CMSC" class="form-control"/><br>
                    <input type="text" name="course5" value="CMSC" class="form-control"/><br><br>
                </div>
                
                <div class="form-group">
                    <label for="info">Additional Info:</label>
                    <textarea class="form-control" rows="5" id="info"></textarea>
                </div>
            </fieldset>
			
			<input type="submit" class="btn btn-primary" name="nextPageButton" value="Next"/>&nbsp;
			<input type = "submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu"/>
		</form>		
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 4");
echo $page;


?>