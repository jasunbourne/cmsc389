<?php

require_once("bootstrap.php");
require_once("applicationSupport.php");

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

if (isset($_POST["nextPageButton"])) {
    $_SESSION["isInternational"] = $_POST["isInternational"];
    $_SESSION["mei"] = $_POST["mei"];
    $_SESSION["umei"] = $_POST["umei"];

    header("Location: apply4.php");
}
else {
    $contactInfo = <<<BODY
        <form action="{$_SERVER['PHP_SELF']}" method="post">
		    <fieldset>
		        <legend>Non-US Students</legend>        
                <div class="form-group">
                    <label for="international">Are you a Non-US Student?</label>
                    <div id="international">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isInternational" id="yes" value="yes" onClick="displayForm(this)" {$isChecked("isInternational", "yes")}>
                            <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isInternational" id="no" value="no" onClick="displayForm(this)" {$isChecked("isInternational", "no")}>
                            <label class="form-check-label" for="no">No</label>
                        </div>
                    </div>
                </div>  
                <div id="form-container" style="display:none;">
                    <div class="form-group">
                        <label for="mei">Have you passed the Maryland English Institute (MEI Evaluation)?</label>
                        <div id="mei">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mei" id="yes" value="yes" {$isChecked("mei", "yes")}>
                                <label class="form-check-label" for="yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="mei" id="no" value="no" {$isChecked("mei", "no")}>
                                <label class="form-check-label" for="no">No</label>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="umei">Are you currently taking a UMEI course?</label>
                        <div id="umei">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="umei" id="yes" value="yes" {$isChecked("umei", "yes")}>
                                <label class="form-check-label" for="yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="umei" id="no" value="no" {$isChecked("umei", "no")}>
                                <label class="form-check-label" for="no">No</label>
                            </div>
                        </div>
                    </div>  
                </div>
            </fieldset>
                        
            <input class="btn btn-primary" type="submit" name="nextPageButton" value="Next"/>
            <input class="btn btn-primary" type="submit" name="returnHomeButton" value="Return to Main Menu" formnovalidate/>
        </form>	
BODY;
}

$page = generatePage($contactInfo, "Apply 3");
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

    displayForm(document.querySelector('input[name="isInternational"]:checked'));

</script>
