<?php

require_once "dbsupport.php";
require_once "bootstrap.php";

$body = "";
$table = "";

$db_connection = getDBConnection();

if (isset($_POST['addStudents'])) {
    session_start();
    $teaching_array = array();
    $grading_array = array();
    $arr_chosen = $_POST['dirIDS'];
    $course_name = $_SESSION['className'];
    foreach ($arr_chosen as $key) {
        $sql = "select directory_id, can_teach from applicants where directory_id like '$key'";
        $res = $db_connection->query($sql);
        while ($recordArray = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            if($recordArray['can_teach'] == 1){
                $teaching_array[] = $recordArray['directory_id'];
            }
            else{
                $grading_array[] = $recordArray['directory_id'];
            }
        }
    }
    foreach ($teaching_array as $key1) {
        $sql2 = "INSERT INTO paired_ta_final_teaching VALUES ('$key1', '$course_name')";
        $res2 = $db_connection->query($sql2);
    }
    foreach ($grading_array as $key2) {
        $sql3 = "INSERT INTO paired_ta_final_grading VALUES ('$key2', '$course_name')";
        $res3 = $db_connection->query($sql3);
    }
}

$table .= "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\" class=\"form-horizontal\">";


$sqlQuery = "select last_name, first_name, email, uid, gpa, is_ta, is_non_us, 
            can_teach, student_type, directory_id 
            from applicants";
$result = $db_connection->query($sqlQuery);
if ($result) {
    $table .= "<table id='myTable' class='table'><thead><tr><td></td><td>First Name</td><td>Last Name</td><td>Email</td><td>Direcotry ID</td><td>GPA</td><td>TA?</td>";
    $table .= "<td>US?</td><td>Can Teach?</td><td>Student Type</td><td></td></tr></thead><tbody>";
    while ($record = $result->fetch_assoc()) {
        $ta = boolToStr($record['is_ta']);
        $us = boolToStr(!$record['is_non_us']);
        $teach = boolToStr($record['can_teach']);
        $table .= "<tr>";
        $table .= "<td><input type='checkbox' name='dirIDS[]' value='{$record['directory_id']}'/></td>";
        $table .= "<td>{$record['first_name']}</td><td>{$record['last_name']}</td><td>{$record['email']}</td><td>{$record['directory_id']}</td>";
        $table .= "<td>{$record['gpa']}</td><td>{$ta}</td><td>{$us}</td><td>{$teach}</td><td>{$record['student_type']}</td><td class='view'><button class='btn btn-info' type='buton'>More</button></td></tr>";
    }
    $table .= "</tbody></table>";
    $table .= "<script>$(document).ready( function () {
                    $('#myTable').DataTable();
                    });</script>";
    mysqli_free_result($result);
} else { 				   ;
    $body = "<h3>There was an error.</h3>";
}
mysqli_close($db_connection);


function boolToStr($bool) {
    return $bool ? "Yes" : "No";
}

$body .= "";

$table .= <<<BODY

                <div class="form-group">
                    
                        <button type='button' class='btn btn-primary' id='returnHomeButton'>Return to Main Menu</button>
                        <input type="submit" class='btn btn-primary' value="Add students" name="addStudents">
                </div>
            </form> 


BODY;





$body .= "<script>
        var btn = document.getElementById('returnHomeButton');
        btn.addEventListener('click', function() {
          document.location.href = 'adminHome.php';
        });
        
        $(document).ready(function() {
    var table = $('#myTable').DataTable();
    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('.view').click( function () {
        var data = table.row(this).data();
        document.location.href = 'displayApplication.php?id='+data[4];
    } );

} );
    </script>";
$page = generatePage($table.$body, "Application");
echo $page;
?>

