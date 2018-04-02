<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

<body>

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
			<h1>UID:</h1>
			<input type="text" name="uid" maxlength="9"/><br><br>
        
            <select name = "semester">
                <option value = "spring"> spring </option>
                <option value = "fall"> fall </option>
            </select>
            <input type = "text" name = "year" pattern = [0-9]{4} />        
			
			<h1>I am a...</h1>
			PhD Student<input type="radio" name="studentType" value = "phd"/>
			MS Student <input type="radio" name="studentType" value = "ms"/>
			
			<h1>Department: </h1>
			<input type="text" name="department"/><br><br>
			
			<h1>Advisor: </h1>
			<input type="text" name="advisor"/><br><br>
			
			<h1>Are you currently a TA</h1>
			No<input type="radio" name="ta" value = "no"/>
			Yes<input type="radio" name="ta" value = "yes"/>
			
			<div class = "well">
			    <header> IF YES</header>
			<select name = "currentStep">
                <option value = "step1"> Step 1 </option>
                <option value = "step2"> Step 2 </option>
                <option value = "step3"> Step 3 </option>
            </select>
		    
		    <h1>Current Course: </h1>
			<input type="text" name="currCourse"/><br><br>
			
		    <h1>Instructor: </h1>
			<input type="text" name="instructor"/><br><br>
            
            </div>
            
            <h1>List any Previous TA Experience: </h1>
			<input type="text" name="experience"/><br><br>
			
			
			<h1>Do you have your MS degree</h1>
			No<input type="radio" name="msdegree" value = "no"/>
			Yes<input type="radio" name="msdegree" value = "yes"/>
			
			<input type="submit" name="nextPageButton" value = "Next"/><br>
			<br>
			<input type = "submit" name = "returnHomeButton" value = "Return to Main Menu"/>
		</form>		
BODY;
}

echo $studentInfo;


?>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>