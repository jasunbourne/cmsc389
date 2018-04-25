<?php

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["firstName"] = $_POST["firstName"];
    $_SESSION["lastName"] = $_POST["lastName"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["phoneNumber"] = $_POST["phoneNumber"];

    header("Location: apply2.php");

}
else {
    $contactInfo = <<<BODY
        <script>
        $(document).ready(function($) {
            $('#phoneNumber').mask('(000) 000-0000');
        });
        </script>
		<form action="{$_SERVER['PHP_SELF']}" method="post">
		    <fieldset>
		        <legend>Contact Information</legend>
                <div class="row">
                    <div class="col">
                        <label for="firstName">First Name:</label>
                        <input class="form-control" id="firstName" type="text" name="firstName" maxlength="50" required/><br>
                    </div>
                    <div class="col">
                        <label for="lastName">Last Name:</label>
                        <input class="form-control" id="lastName" type="text" name="lastName" maxlength="50" required/><br>
                    </div>
                </div>
            
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" id="email" type="email" name="email" required/><br>
                </div>
                
                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input class="form-control" id="phoneNumber" type="text" pattern = "\([0-9]{3}\) [0-9]{3}-[0-9]{4}" placeholder="(XXX)XXX-XXXX" name="phoneNumber" required/><br>
                </div>
            </fieldset>
						
			<input class="btn btn-primary" type="submit" name="nextPageButton" value="Next"/>
			<input class="btn btn-primary" type="submit" name="returnHomeButton" value="Return to Main Menu" formnovalidate/>
		</form>		
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 1");
echo $page;

?>
