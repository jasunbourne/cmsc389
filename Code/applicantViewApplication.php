<?php
require_once("showApplication.php");
require_once("applicationSupport.php");
require_once("bootstrap.php");

session_start();

$directoryId = getFieldValue("directoryId", "");

$body = showApplication($directoryId);

$body .= <<<EOBODY
    <a class="btn btn-primary" href="applicantHome.php">Back</a>
EOBODY;

$page = generatePage($body, "Application");
echo $page;

?>