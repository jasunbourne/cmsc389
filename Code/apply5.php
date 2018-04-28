<?php

require_once("applicationSupport.php");

session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");


$uploadResult = "";
if (isset($_POST["nextPageButton"])) {
    // serverUploadDirectory represents the directory where uploaded files will be placed
    // Replace with your own path.

    // Create directory for files if it does not exist
    $fileName = $_FILES['filename']['name'];
    $serverUploadDirectory = "/test";
    if (!file_exists($serverUploadDirectory)) {
        mkdir($serverUploadDirectory);
    }

    // Create directory for this users transcript
    $userDirectory = $serverUploadDirectory."/".getFieldValue("directoryId", "default");
    if (!file_exists($userDirectory)) {
        mkdir($userDirectory);
    }
    else {
        $files = glob($userDirectory."/*"); // get all file names
    }
    $tmpFileName = $_FILES['filename']['tmp_name'];
    $serverFileName = $userDirectory."/".$fileName;

    if(pathinfo($fileName, PATHINFO_EXTENSION) === "pdf") {
        // checking the file was uploaded via HTTP POST (to avoid tricking the
        // script into working on files it should not be working on (e.g., passwd)
        if (!is_uploaded_file($tmpFileName))
            $uploadResult = "<b>File upload failed</b>";
        else {
            // At this point you can check the validity of the file type, size, etc.
            // copying file from temporary location
            if (!move_uploaded_file($tmpFileName, $serverFileName))
                $uploadResult = "<b>File upload failed</b>";
            else {
                if (isset($files)) {
                    // Remove old transcript
                    foreach ($files as $file) { // iterate files
                        if (is_file($file))
                            unlink($file); // delete file
                    }
                }
                header("Location: apply6.php");
            }
        }
    }
    else {
        $uploadResult = "<b>Transcript must be in pdf format</b>";
    }
}
$form = <<<BODY
    <form action="{$_SERVER['PHP_SELF']}" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Signature</legend>
            <div class="form-group">
                <label for="file">Unofficial Transcript:</label>
                <input type="file" name="filename" accept=".pdf" /><br />
            </div>

            <input type="submit" class="btn btn-primary" name="nextPageButton" value="Next"/>&nbsp;
            <input type="submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu"/>
        </fieldset>
    </form>
         
BODY;


require_once("bootstrap.php");

$page = generatePage($form.$uploadResult, "Apply to TA");
echo $page;


?>