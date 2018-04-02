<?php

session_start();

$studentInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: main.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["uid"] = $_POST["uid"];
    $_SESSION["semester"] = $_POST["semester"];
    $_SESSION["year"] = $_POST["year"];
    $_SESSION["studentType"] = $_POST["studentType"];
    $_SESSION["department"] = $_POST["department"];
    $_SESSION["advisor"] = $_POST["advisor"];
    $_SESSION["ta"] = $_POST["ta"];
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
			<div class="form-group">
			    <strong>UID:</strong>
			    <input type="text" name="uid" maxlength="9"/><br>
            </div>
			
            <div class="form-group">
                <strong>Semseter:</strong>
                <select class="select" name="semester">
                    <option value = "spring">Spring</option>
                    <option value = "fall">Fall</option>
                </select>
            </div>
            
            <div class="form-group">
                <strong>Year:</strong>
                <input type="text" name="year" pattern=[0-9]{4}/>  
            </div>
                  
			<div class="form-group">
			    <strong>I am a...</strong>
                <input type="radio" name="studentType" value="phd"/>&nbsp;PhD Student
                <input type="radio" name="studentType" value="ms"/>&nbsp;MS Student
            </div>
			
			<div class="form-group">
			    <strong>Department: </strong>
			    <input type="text" name="department"/><br>
            </div>
            
            <div class="form-group">
			    <strong>Advisor: </strong>
                <input type="text" name="advisor"/><br>
            </div>
			
			<div>
			    <strong>Are you currently a TA?</strong>
			    <input type="radio" name="ta" value = "yes"/>&nbsp;Yes
                <input type="radio" name="ta" value = "no"/>&nbsp;No
            </div>		    
		
			<div class="form-group well">
			    <header> If yes</header>
                <select name = "currentStep">
                    <option value = "step1">Step 1</option>
                    <option value = "step2">Step 2</option>
                    <option value = "step3">Step 3</option>
                </select><br>
		    
                <strong>Current Course: </strong>
                <input type="text" name="currCourse"/><br>
                
                <strong>Instructor: </strong>
                <input type="text" name="instructor"/><br>
            
            </div>
            
            <div>
                <strong>List any Previous TA Experience: </strong>
			    <input type="text" name="experience"/><br>
            </div>
            
			
			<div>
			    <strong>Do you have your MS degree</strong>
			    <input type="radio" name="msdegree" value = "yes"/>&nbsp;Yes
			    <input type="radio" name="msdegree" value = "no"/>&nbsp;No
            </div>
            
            <br>
				
			<input class="btn btn-primary" type="submit" name="nextPageButton" value = "Next"/>
			<input class="btn btn-primary" type = "submit" name = "returnHomeButton" value = "Return to Main Menu"/>
		</form>		
BODY;
}

require_once("bootstrap.php");

$page = generatePage($studentInfo, "Apply 4");
echo $page;


?>
