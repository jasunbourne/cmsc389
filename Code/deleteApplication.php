<?php
require_once("dbsupport.php");
require_once("applicationSupport.php");

session_start();

$directoryID = getFieldValue("directoryId", "default");

$db_connection = getDBConnection();

$sqlQuery = "DELETE FROM `experience` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if (!$result) {
    echo "failed to delete application";
}

$sqlQuery = "DELETE FROM `applicants` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if (!$result) {
    echo "failed to delete application";
}

$sqlQuery = "DELETE FROM `preferred_courses` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if (!$result) {
    echo "failed to delete application";
}

$sqlQuery = "DELETE FROM `transcripts` WHERE directory_id = '$directoryID'";
$result = $db_connection->query($sqlQuery);
if (!$result) {
    echo "failed to delete application";
}

mysqli_close($db_connection);
session_unset();

$_SESSION["directoryId"] = $directoryID;

echo "Application Deleted";

?>