<?php
    require_once("showApplication.php");
    require_once("applicationSupport.php");
    require_once("bootstrap.php");

    $body = showApplication($_GET["id"]);

$body .= <<<EOBODY
    <form action="{$_SERVER["PHP_SELF"]}" method="post">
         <input type = "submit" class="btn btn-primary" name="allAppsBtn" value="View all applications"/> 
    </form>
EOBODY;

    $page = generatePage($body, "Application");
    echo $page;

?>