<?php

session_start();

$studentInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["uid"] = $_POST["uid"];
    $_SESSION["gpa"] = $_POST["gpa"];
    $_SESSION["entrySemester"] = $_POST["entrySemester"];
    $_SESSION["year"] = $_POST["year"];
    $_SESSION["studentType"] = $_POST["studentType"];
    $_SESSION["department"] = $_POST["department"];
    $_SESSION["advisor"] = $_POST["advisor"];
    $_SESSION["currentlyTA"] = $_POST["currentlyTA"];
    $_SESSION["currentStep"] = $_POST["currentStep"];
    $_SESSION["currCourse"] = $_POST["currCourse"];
    $_SESSION["instructor"] = $_POST["instructor"];
    $_SESSION["experience"] = $_POST["experience"];
    $_SESSION["msdegree"] = $_POST["msdegree"];

    header("Location: apply3.php");

}
else {
    $studentInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
		    <fieldset>
		        <legend>Student Information</legend>		    
                <div class="form-group">
                    <label for="uid">UID:</label>
                    <input class="form-control" type="text" id="uid" name="uid" maxlength="9"/><br>
                </div>
                
                <div class="row">
                    <div class="col">
                        <label for="entrySemester">Entry Semester:</label>
                        <select class="form-control" name="entrySemester" id="entrySemester">
                            <option value = "spring">Spring</option>
                            <option value = "fall">Fall</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="entryYear">Entry Year:</label>
                        <input class="form-control" id="entryYear" type="text" name="entryYear" maxlength="4" pattern=[0-9]{4} required/><br>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="gpa">Cumulative GPA:</label>
                    <input class="form-control" id="gpa" type="number" name="year" max="4" min="0" step=".01">  
                </div>
    
                <div class="form-group">
                    <label for="studentType">Student Type:</label>
                    <div id="studentType">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="studentType" id="phd" value="phd">
                            <label class="form-check-label" for="phd">PhD Student</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="studentType" id="ms" value="ms">
                            <label class="form-check-label" for="ms">MS Student</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="studentType" id="ugrad" value="ugrad">
                            <label class="form-check-label" for="ugrad">Undergraduate Student</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input class="form-control" id="department" type="text" name="department" value="Computer Science">  
                </div>
                
                <div class="form-group">
                    <label for="advisor">Advisor:</label>
                    <input class="form-control" id="advisor" type="text" name="advisor">  
                </div>
                
                <div class="form-group">
                    <label for="currentTA">Are you currently a TA?</label>
                    <div id="currentTA">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="currentlyTA" id="yes" value="yes" onClick="displayForm(this)">
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="currentlyTA" id="no" value="no" onClick="displayForm(this)">
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>    
            
                <div class="form-group well" id="form-container" style="display:none;">
                    <label for="currentStep">Current Step:</label>
                    <select class="form-control" name="currentStep" id="currentStep">
                        <<option value="Step 0">Step 0 (Undergraduate)</option>
                        <option value="Step I">Step I (first-year graduate assistants only)</option>
                        <option value="Step II">Step II (second-year assistants, or students holding an MS degree)</option>
                        <option value="Step III">Step III (Ph.D. students officially advanced to candidacy)</option>
                    </select>
                    
                    <div class="row">
                        <div class="col">
                            <label for="currCourse">Current Course:</label>
                            <input class="form-control" type="text" name="currCourse" id="currCourse"/><br>
                        </div>
                        <div class="col">
                            <label for="instructor">Instructor:</label>
                            <input class="form-control" type="text" name="instructor" id="instructor"/><br>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="experience">List any Previous TA Experience:</label>
                    <input class="form-control" id="experience" type="text" name="experience">  
                </div>
                
                <div class="form-group">
                    <label for="hasMS">Do you have your MS degree?</label>
                    <div id="hasMS">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="msdegree" id="yes" value="yes">
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="msdegree" id="no" value="no">
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>    
            </fieldset>
            
			<input class="btn btn-primary" type="submit" name="nextPageButton" value = "Next"/>
			<input class="btn btn-primary" type = "submit" name = "returnHomeButton" value = "Return to Main Menu" formnovalidate/>
		</form>
BODY;
}

require_once("bootstrap.php");

$page = generatePage($studentInfo, "Apply 4");
echo $page;
?>


<script type="text/javascript">
    function displayForm(c) {
        if (c.value === "yes") {
            document.getElementById("form-container").style.display = 'inline';
        } else if (c.value === "no") {
            document.getElementById("form-container").style.display = 'none';
        }
    }
</script>