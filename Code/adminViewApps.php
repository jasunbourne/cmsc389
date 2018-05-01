<?php

    require_once "dbsupport.php";
    require_once "bootstrap.php";

    $body = "";
    $table = "";

    $db_connection = getDBConnection();
    session_start();
    $class_name = $_SESSION['className'];

    $sqlQuery = "select last_name, first_name, email, uid, gpa, is_ta, is_non_us, 
            can_teach, student_type, applicants.directory_id 
            from applicants, preferred_courses where applicants.directory_id = preferred_courses.directory_id and course like '$class_name'";
    $result = $db_connection->query($sqlQuery);
    if ($result) {
        $table = "<table id='myTable' class='table'><thead><tr><td>First Name</td><td>Last Name</td><td>Email</td><td>Direcotry ID</td><td>GPA</td><td>TA?</td>";
        $table .= "<td>US?</td><td>Can Teach?</td><td>Student Type</td></tr></thead><tbody>";
        while ($record = $result->fetch_assoc()) {
            $ta = boolToStr($record['is_ta']);
            $us = boolToStr(!$record['is_non_us']);
            $teach = boolToStr($record['can_teach']);
            $table .= "<tr><td>{$record['first_name']}</td><td>{$record['last_name']}</td><td>{$record['email']}</td><td>{$record['directory_id']}</td>";
            $table .= "<td>{$record['gpa']}</td><td>{$ta}</td><td>{$us}</td><td>{$teach}</td><td>{$record['student_type']}</td></tr>";
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

    $body .= "<button type='button' class='btn btn-primary' id='returnHomeButton'>Return to Main Menu</button>";
    $body .= "<script>
        var btn = document.getElementById('returnHomeButton');
        btn.addEventListener('click', function() {
          document.location.href = 'adminHome.php';
        });
        
        $(document).ready(function() {
    var table = $('#myTable').DataTable();
     
    $('#myTable tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        document.location.href = 'displayApplication.php?id='+data[3];
    } );
} );
    </script>";
    $page = generatePage($table.$body, "Application");
    echo $page;
?>

