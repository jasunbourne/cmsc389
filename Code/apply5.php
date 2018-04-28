<?php

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    header("Location: applicantHome.php");
}
else {
    $contactInfo = <<<BODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
            <fieldset>
		        <legend>Signature</legend>
                <div class="form-group">
                    <p>
                        By accepting a position as a teaching assistant in the Department of Computer 
                        Science, you agree that you will report to your assigned instructors/professors at least 3 business
                        days before the start of classes and that you will be available at least three days after the last
                        scheduled day of exams.
                    </p>
                    <label class="checkbox-inline"><input type="checkbox" value="" required>I agree</label>
                </div>
                
                <input type="submit" class="btn btn-primary" name="nextPageButton" value="Submit Application"/>&nbsp;
			    <input type="submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu" formnovalidate/>
            </fieldset>
        </form>
             
BODY;
}

require_once("bootstrap.php");

$page = generatePage($contactInfo, "Apply 4");
echo $page;


?>