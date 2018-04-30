<?php
    require_once("applicationSupport.php");
    require_once("dbsupport.php");
    require_once "bootstrap.php";

    session_start();

    if (isset($_POST['allAppsBtn'])) {
        if (strpos( $_SERVER['REQUEST_URI'], 'displayApplication.php/') !== false)
            header("Location: ../adminViewApps.php");
        else
            header("Location: adminViewApps.php");
    }

    if (!empty($_GET['id'])) {
        $directoryID = $_GET['id'];


        $table = "transcripts";

        $db_connection = getDBConnection();

        $sqlQuery = "select last_name, first_name, email, phone, uid, gpa, entry_semester, entry_year, student_type, 
            department, advisor, is_ta, ta_step, current_course, instructor, has_ms, is_non_us, passed_mei, taking_umei, 
            can_teach, prefers_teach, position_type, semester, year, additional_info, directory_id 
            from applicants where directory_id = '{$directoryID}'";
        $result = $db_connection->query($sqlQuery);
        if ($result) {
            $recordArray = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } else {
            $body = "<h3>Could not find an application.</h3>";
        }

        $sqlQuery = "SELECT * FROM `experience` WHERE directory_id = '$directoryID'";
        $result = $db_connection->query($sqlQuery);
        if ($result) {
            $experience = "";
            if (mysqli_num_rows($result) > 0) {
                while ($courses = mysqli_fetch_assoc($result)) {
                    $experience .= "{$courses['course']} ";
                }
            }
            else {
                $experience = "None";
            }
            mysqli_free_result($result);
        }

        $sqlQuery = "SELECT * FROM `preferred_courses` WHERE directory_id = '$directoryID'";
        $result = $db_connection->query($sqlQuery);
        if ($result) {
            $preferredCourses = "";
            if (mysqli_num_rows($result) > 0) {
                while ($courses = mysqli_fetch_assoc($result)) {
                    $preferredCourses .= "{$courses['course']} ";
                }
            }
            else {
                $preferredCourses = "None";
            }
            mysqli_free_result($result);
        }

        $transcript = "";
        $sqlQuery = "select name from $table where directory_id = '{$directoryID}'";
        $result = $db_connection->query($sqlQuery);
        if ($result) {
            $transcriptArray = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                $transcriptName = $transcriptArray['name'];
                $transcript = "<a target='_blank' href='displayTranscript.php?id=$directoryID'>$transcriptName</a>";
            }
            mysqli_free_result($result);
        }
        mysqli_close($db_connection);

        if ($recordArray['is_ta'])
            $isTaRow = "<td colspan=\"3\"><b>Currently a TA.</b></td><td colspan=\"3\"><b>Step:</b> {$recordArray['ta_step']}</td><td colspan=\"3\"><b>Course:</b> {$recordArray['current_course']}</td><td colspan=\"3\"><b>Instructor:</b> {$recordArray['instructor']}</td>";
        else
            $isTaRow = "<td colspan='12'><b>Not currently a TA.</b></td>";

        $passedMei = $recordArray['passed_mei'] ? "Passed MEI." : "Did not pass MEI.";
        $takingMei = $recordArray['taking_umei'] ? "Currently taking UMEI course.": "Not currently taking UMEI course";
        $isUs = $recordArray['is_non_us'] ? "Not a US student. {$passedMei} {$takingMei}" : "US Student.";

        $wantsToTeach = $recordArray['prefers_teach'] ? "and prefers to teach." : "but does not prefer to teach.";
        $canTeach = $recordArray['can_teach'] ? "Can teach {$wantsToTeach}" : "Cannot teach.";
        $positon = $recordArray['position_type'] === "parttime" ? "Part time" : "Full time";

        $body = <<<EOBODY
            <div>
                <table border="2" width="100%" class="table" id="my-table">
                    <tr><td colspan="4"><b>Name:</b> {$recordArray['first_name']} {$recordArray['last_name']} </td><td colspan="4"><b>Email:</b> {$recordArray['email']}</td>
                    <td colspan="4"><b>Phone:</b> {$recordArray['phone']}</td></tr>
                    <tr><td colspan="3"><b>UID:</b> {$recordArray['uid']}</td><td colspan="3"><b>GPA:</b> {$recordArray['gpa']}</td>
                    <td colspan="3"><b>Entry Semester:</b> {$recordArray['entry_semester']} {$recordArray['entry_year']} </td><td colspan="3"><b>Student type:</b> {$recordArray['student_type']}</td></tr>
                    <tr><td colspan="12">&nbsp;</td></tr>
                    <tr><td colspan="6"><b>Department:</b> {$recordArray['department']}</td><td colspan="6"><b>Advisor:</b> {$recordArray['advisor']}</td></tr>
                    <tr>{$isTaRow}</tr>
                    <tr><td colspan="12"><b>TA Experience: </b>$experience</td></tr>
                    <tr><td colspan="12">&nbsp;</td></tr>
                    <tr><td colspan="12">{$isUs}</td></tr>
                    <tr><td colspan="12">{$canTeach}</td></tr>
                    <tr><td colspan="6"><b>Applying for:</b> {$positon}</td><td colspan="6"><b>Semester</b> {$recordArray['semester']} {$recordArray['year']}</td></tr>
                    <tr><td colspan="12"><b>Preferred Courses: </b>$preferredCourses</td></tr>
                    <tr><td colspan="12">&nbsp;</td></tr>
                    <tr><td colspan="12"><b>Transcript: </b> $transcript</td></tr>
                    <tr><td colspan="12">Additional info: {$recordArray['additional_info']}</td></tr>
                </table>
            </div>
EOBODY;
    } else {
        $body = "No directory id was selected.";
    }


    $body .= <<<EOBODY
                <form action="{$_SERVER["PHP_SELF"]}" method="post">
                     <input type = "submit" class="btn btn-primary" name="allAppsBtn" value="View all applications"/> 
                </form>
EOBODY;



    $page = generatePage($body, "Application");
    echo $page;


?>