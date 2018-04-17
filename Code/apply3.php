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

    header("Location: apply4.php");

}
else {
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
			<strong>Have you passed the Maryland English Institute (MEI Evaluation)?:</strong>
			<div class="form-group">
			    <input type="radio" name="mei" value = "yes"/>&nbsp;Yes
                <input type="radio" name="mei" value = "no"/>&nbsp;No
            </div>
			
            <strong>Are you currently taking a UMEI course?:</strong>
			<div class="form-group">
			    <input type="radio" name="umei" value = "yes"/>&nbsp;Yes
                <input type="radio" name="umei" value = "no"/>&nbsp;No
            </div>
						
			<input class="btn btn-primary" type="submit" name="nextPageButton" value="Next"/>
			<input class="btn btn-primary" type="submit" name="returnHomeButton" value="Return to Main Menu"/>
		</form>		
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 3");
echo $page;

?>
