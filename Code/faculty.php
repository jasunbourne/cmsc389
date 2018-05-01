<?php
require_once ("dbsupport.php");
require_once ("bootstrap.php");

$body = "";

if(isset($_POST["returnButton"]))
    header("Location: faculty.php");

if (isset($_POST["displayAssigned"])) {
    //query to retrieve all assigned TAs
    $body = "";

    $db_connection = getDBConnection();

    $sqlQuery =
        "select directory_id, course from paired_ta_final";
    $result = $db_connection->query($sqlQuery);
    if ($result) {
        $table = "<table id='taTable' class='table'><thead><tr><td>Directory ID</td><td>Assigned Course</td></tr></thead><tbody>";
        while ($record = $result->fetch_assoc()) {
            $table .= "<tr><td>{$record['directory_id']}</td><td>{$record['course']}</td>";
        }
        $table .= "</tbody></table>";

        $body .= $table;

        $bottom = <<<EOBODY
            <form action = "faculty.php" method = "post">
                <input type = "submit" name = "returnButton" class = "btn btn-info" value = "Back"/>
            </form>
EOBODY;

        $body .= $bottom;


        mysqli_free_result($result);
    } else { 				   ;
        $body = "<h3>There was an error.</h3>";
    }
    mysqli_close($db_connection);

}

if (isset($_POST["displayUnassigned"])) {
    $body = "";

    $db_connection = getDBConnection();

    $sqlQuery =
        "SELECT a.first_name as first_name, a.last_name as last_name, a.directory_id as directory_id
        FROM applicants a
        LEFT JOIN paired_ta_final pat ON pat.directory_id = a.directory_id
        WHERE pat.directory_id IS NULL";
    $result = $db_connection->query($sqlQuery);
    if ($result) {
        $table = "<table id='taTable' class='table'><thead><tr><td>Directory ID</td><td>Name</td><td>Transcripts</td></tr></thead><tbody>";
        while ($record = $result->fetch_assoc()) {
                $transcriptName = $record['first_name']." transcript";
                $transcript = "<a target='_blank' href='displayTranscript.php?id={$record['directory_id']}'>$transcriptName</a>";
                $table .= "<tr><td>{$record['directory_id']}</td><td>{$record['first_name']}.{$record['last_name']}</td><td>$transcript</td>";
        }
        $table .= "</tbody></table>";

        $body .= $table;

        $bottom = <<<EOBODY
            <form action = "faculty.php" method = "post">
                <input type = "submit" name = "returnButton" class = "btn btn-info" value = "Back"/>
            </form>
EOBODY;

        $body .= $bottom;

        mysqli_free_result($result);
    } else { 				   ;
        $body = "<h3>There was an error.</h3>";
    }
    mysqli_close($db_connection);
}

if (isset($_POST["provideFeedback"])) {
    //query to retrieve one TA's info and pdf - with text area to submit feedback
    $id = $_POST["taID"];
    $body = <<<EOBODY
    <form action = "faculty.php" method = "post">
         <strong>$id</strong><br>
         <textarea rows="4" cols="50" name="feedback" maxlength = "400"></textarea>
         <input type = "hidden" name = "taID" value = $id />
         <input type = "submit" name = "submitFeedback" class = "btn btn-info" id = "submitFeedback" value = "Submit Feedback"/>
    </form>
EOBODY;
}

if (isset($_POST["submitFeedback"])) {
    $uid = $_POST["taID"];
    $feedback = $_POST["feedback"];
    $table = "feedback";
    $db_connection = getDBConnection();
    $sqlQuery = "insert INTO feedback (`directory_id`, `feedback`) VALUES ('$uid', '$feedback')";
    $result = $db_connection->query($sqlQuery);

    if (!$result)
    {
        echo("Errorcode: " . mysqli_error($db_connection));
    }


    mysqli_close($db_connection);

}

if (!isset($_POST["displayAssigned"]) and !isset($_POST["displayUnassigned"]) and !isset($_POST["provideFeedback"])) {
    $body = <<<EOBODY
    <form action = "faculty.php" method = "post">
        <input type = "submit" name = "displayAssigned" class="btn btn-info" id = "displayAssigned" value = "Display Assigned TAs"/>
        <input type = "submit" name = "displayUnassigned" class="btn btn-info" id = "displayAssigned" value = "Display Unassigned TAs"/> <br>
        
        Insert TA's ID on which you'd like to provide feedback <input type = "text" name = "taID" id = "taName"/>
        <input type = "submit" name = "provideFeedback" class="btn btn-info" id = "provideFeedback" value = "Provide Feedback on TA"/>
        
    </form>
EOBODY;
}

$page = generatePage($body, "Faculty");
echo $page;

?>
