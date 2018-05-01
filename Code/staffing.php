<?php


$body = <<<BODY
    <table class="table">
    <thead><tr><td>Course</td><td>Students Enrolled</td><td>Teaching TAs</td><td>Grading TAs</td></tr></thead>
    <tbody>
    <tr style="background-color:red"><td>CMSC131</td><td>130</td><td>5</td><td>5</td></tr>
    <tr style="background-color:green"><td>CMSC132</td><td>120</td><td>10</td><td>5</td></tr>
    </tbody>
</table>
BODY;

require_once("bootstrap.php");

$page = generatePage($body, "Admin Home");
echo $page;

?>