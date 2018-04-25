<?php


$body = <<<BODY
    <h1>TA Application</h1>
    <a class="btn btn-primary" href="apply1.php">Apply/Edit Application</a>
    <a class="btn btn-primary" href="deleteApplication.php">Remove Application</a>

BODY;

require_once("bootstrap.php");

$page = generatePage($body, "Applicant Home");
echo $page;
?>