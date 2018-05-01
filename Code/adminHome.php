<?php
$body = "";

session_start();

require_once("applicationSupport.php");

if (isset($_POST['submitClass'])) {
    $_SESSION['className'] = trim($_POST['className']);
    header("Location: adminChoose.php");
}

if (isset($_POST['viewApps'])) {
    header("Location: adminViewApps.php");
}

if (isset($_POST['viewCourses'])) {
    header("Location: viewCourses.php");
}

if (isset($_POST['addCourse'])) {
    header("Location: addCourse.php");
}



if (!isset($_POST['appButton']) and !isset($_POST['adminButton']) and !isset($_POST['facultyButton'])) {
    $body = <<<BODY
        <div class="container">
            <div class="container">

                <form action="{$_SERVER["PHP_SELF"]}" method="post">
                    <div class="form-group">
                        Enter Class Name:<br><input type="text" name="className" required/>
                    </div>
                    <div class="form-group"> 
                        <input type = "submit" class="btn btn-info" name="submitClass" value = "Assign TA's"/>
                        <input type="submit" class="btn btn-info" name="viewApps" value="View TA Applications" formnovalidate/>
                    </div>
                    
                    <hr>
               
                    <div class="form-group"> 
                        <input type = "submit" class="btn btn-info" name="addCourse" value ="Add a course" formnovalidate/>
                        <input type="submit" class="btn btn-info" name="viewCourses" value="View courses" formnovalidate/>
                    </div>
                </form>
            </div>
        </div>
    </div>
BODY;
}

require_once("bootstrap.php");

$page = generatePage($body, "Admin Home");
echo $page;


?>