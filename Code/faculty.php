<?php

$body = "";

if (isset($_POST["displayAssigned"])) {
    //query to retrieve all assigned TAs
}

if (isset($_POST["displayUnassigned"])) {
    //query to retrieve all un assigned TAs
}

if (isset($_POST["provideFeedback"])) {
    //query to retrieve one TA's info and pdf - with text area to submit feedback
}

if (!isset($_POST["displayAssigned"]) and !isset($_POST["displayUnassigned"]) and !isset($_POST["provideFeedback"])) {
    $body = <<<EOBODY
    <form action = "faculty.php" method = "post">
        <input type = "submit" name = "displayAssigned" id = "displayAssigned" value = "Display Assigned TAs"/>
        <input type = "submit" name = "displayUnassigned" id = "displayAssigned" value = "Display Unassigned TAs"/> <br>
        
        Insert TA's ID on which you'd like to provide feedback <input type = "text" name = "taID" id = "taName" />
        <input type = "submit" name = "provideFeedback" id = "provideFeedback" value = "Provide Feedback on TA"/>
        
    </form>
EOBODY;
}


echo $body;

?>
