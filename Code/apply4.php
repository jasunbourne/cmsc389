<?php

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: main.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["position"] = $_POST["position"];
    $_SESSION["semester"] = $_POST["semester"];
    $_SESSION["year"] = $_POST["year"];
    $_SESSION["course1"] = $_POST["course1"];
    $_SESSION["course2"] = $_POST["course2"];
    $_SESSION["course3"] = $_POST["course3"];
    $_SESSION["course4"] = $_POST["course4"];
    $_SESSION["course5"] = $_POST["course5"];

    header("Location: apply2.php");

}
else {
    $date = date("Y");
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
		    <strong>First Position Type:</strong>
		    <div class="form-group">
			    <input type="radio" name="position" value="1"/>&nbsp;Full-time 20hrs/week<br>
			    <input type="radio" name="position" value="2"/>&nbsp;Part-time 10hrs/week
            </div>
			
			
			<strong>Semester:</strong>
			<div class="form-group">
			    <input type="radio" name="semester" value="1"/>&nbsp;Fall<br>
                <input type="radio" name="semester" value="2"/>&nbsp;Spring<br>
                <input type="radio" name="semester" value="3"/>&nbsp;Summer<br>
            </div>
			
			
			<strong>Year:</strong>
			<div>
			    <input type="text" name="year" value=$date /><br><br>
            </div>
			
			
			<strong>Preferred Courses:</strong>
			<div>
			    <input type="text" name="course1" value="CMSC"/><br>
                <input type="text" name="course2" value="CMSC"/><br>
                <input type="text" name="course3" value="CMSC"/><br>
                <input type="text" name="course4" value="CMSC"/><br>
                <input type="text" name="course5" value="CMSC"/><br><br>
            </div>
			
            
			<strong>Additional Info:</strong>
			<div>
			    <textarea name="info"></textarea><br><br>
		    </div>
			
			
			<input type="submit" class="btn btn-primary" name="nextPageButton" value="Next"/>&nbsp;
			<input type = "submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu"/>
		</form>		
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 4");
echo $page;


?>