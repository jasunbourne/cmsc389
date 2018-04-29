<?php
    require_once("applicationSupport.php");
    require_once("dbsupport.php");
    require_once "bootstrap.php";

    session_start();

    $directoryID = "jpollock";
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
    } else { 				   ;
        $body = "<h3>Could not find an application.</h3>";
    }
    mysqli_close($db_connection);

    if ($recordArray['is_ta'])
        $isTaRow = "<td colspan=\"3\"><b>Currently a TA.</b></td><td colspan=\"3\"><b>Step:</b> {$recordArray['ta_step']}</td><td colspan=\"3\"><b>Course:</b> {$recordArray['current_course']}</td><td colspan=\"3\"><b>Instructor:</b> {$recordArray['instructor']}</td>";
    else
        $isTaRow = "<td colspan='12'><b>Not currently a TA.</b></td>";

    $passedMei = $recordArray['passed_mei'] ? "Passed MEI." : "Did not pass MEI.";
    $takingMei = $recordArray['taking_umei'] ? "Currentlty taking UMEI course." :
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
                <tr><td colspan="12">&nbsp;</td></tr>
                <tr><td colspan="12">{$isUs}</td></tr>
                <tr><td colspan="12">{$canTeach}</td></tr>
                <tr><td colspan="6"><b>Applying for:</b> {$positon}</td><td colspan="6"><b>Semester</b> {$recordArray['semester']} {$recordArray['year']}</td></tr>
                <tr><td colspan="12">&nbsp;</td></tr>
                <tr><td colspan="12">Additional info: {$recordArray['additional_info']}</td></tr>
            </table>  
        </div>
EOBODY;



$page = generatePage($body, "Application");
echo $page;


?>