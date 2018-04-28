<?php

require_once("applicationSupport.php");
require_once("dbsupport.php");

session_start();

$directoryID = getFieldValue("directoryId", "default");
$table = "transcripts";

$db_connection = getDBConnection();

$sqlQuery = "select mimType, data, name from $table where directory_id = '{$directoryID}'";
echo $sqlQuery;
$result = $db_connection->query($sqlQuery);
if ($result) {
    $recordArray = mysqli_fetch_assoc($result);
    header("Content-type: "."{$recordArray['mimType']}");
    echo $recordArray['data'];
    mysqli_free_result($result);
} else { 				   ;
    $body = "<h3>Failed to retrieve document $fileToRetrieve: ".mysqli_error($db)." </h3>";
}
mysqli_close($db_connection);

?>