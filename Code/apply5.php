<?php

require_once("applicationSupport.php");
require_once("dbsupport.php");


session_start();

$contactInfo = "";

if(isset($_POST["returnHomeButton"]))
    header("Location: applicantHome.php");

$uploadResult = "";
$directoryID = getFieldValue("directoryId", "default");
$table = "transcripts";

$previousFile = "";
$isRequired = "required";

$db_connection = getDBConnection();

$sqlQuery = "select name from $table where directory_id = '{$directoryID}'";
$result = $db_connection->query($sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $oldFileName = $recordArray['name'];
        $isRequired = "";
        $previousFile = "<p>Transcript on File: <a target='_blank' href='displayTranscript.php'>$oldFileName</a></p>";
    }
    mysqli_free_result($result);
} else { 				   ;
    $body = "<h3>Failed to retrieve document existing transcript ".mysqli_error($db)." </h3>";
}
mysqli_close($db_connection);


if (isset($_POST["nextPageButton"])) {
    // serverUploadDirectory represents the directory where uploaded files will be placed
    // Replace with your own path.

    $fileName = $_FILES['filename']['name'];
    if (empty($isRequired) and empty($fileName)) {
        header("Location: apply6.php");
    }

    $tmpFileName = $_FILES['filename']['tmp_name'];

    $docMimeType = "application/pdf";

    if(pathinfo($fileName, PATHINFO_EXTENSION) === "pdf") {
        // checking the file was uploaded via HTTP POST (to avoid tricking the
        // script into working on files it should not be working on (e.g., passwd)
        $fileData = addslashes(file_get_contents($tmpFileName));

        $db_connection = getDBConnection();

        $sqlQuery = "replace into $table (directory_id, name, mimType, data) values ";
        $sqlQuery .= "('{$directoryID}', '{$fileName}', '{$docMimeType}', '{$fileData}')";
        $result = $db_connection->query($sqlQuery);
        mysqli_close($db_connection);
        if ($result) {
            header("Location: apply6.php");
        }
        else{
            $uploadResult = "<h3>Failed to add document $fileName</h3>";
        }
    }
    else {
        $uploadResult = "<b>Transcript must be in pdf format</b>";
    }
}
$form = <<<BODY
    <form action="{$_SERVER['PHP_SELF']}" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Unofficial Transcript</legend>
            <div class="form-group">
                <label for="file">Unofficial Transcript:</label>
                <input type="file" name="filename" accept=".pdf" $isRequired /><br />
            </div>
            $previousFile
            <br>
            <input type="submit" class="btn btn-primary" name="nextPageButton" value="Next"/>&nbsp;
            <input type="submit" class="btn btn-primary" name = "returnHomeButton" value = "Return to Main Menu"/>
        </fieldset>
    </form>
         
BODY;


require_once("bootstrap.php");

$page = generatePage($form.$uploadResult, "Apply to TA");
echo $page;


?>