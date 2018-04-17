<?php

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: main.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["firstName"] = $_POST["firstName"];
    $_SESSION["lastName"] = $_POST["lastName"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["phoneNumber"] = $_POST["phoneNumber"];

    header("Location: apply2.php");

}
else {
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
			<strong>First Name:</strong>
			<div class="form-group">
			    <input type="text" name="firstName" maxlength="50"/><br>
            </div>
			
			<strong>Last Name:</strong>
			<div class="form-group">
			    <input type="text" name="lastName" maxlength = "50"/><br>
            </div>
		
			<strong>Email:</strong>
			<div class="form-group">
			    <input type="email" name="email"/><br>
            </div>
			
			<strong>Phone Number format (XXX)XXX-XXXX:</strong>
			<div class="form-group">
			    <input type="text" pattern = "\([0-9]{3}\)[0-9]{3}-[0-9]{4}" name="phoneNumber"/><br>
            </div>
						
			<input class="btn btn-primary" type="submit" name="nextPageButton" value="Next"/>
			<input class="btn btn-primary" type="submit" name="returnHomeButton" value="Return to Main Menu"/>
		</form>		
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 1");
echo $page;

?>
