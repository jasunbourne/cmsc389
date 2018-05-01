<?php 

require_once("dbsupport.php");

session_start();
$bottomPart = "";
$teaching_array = array();
$grading_array = array();
$final_teaching_array = array();
$final_grading_array = array();
$all_students_array = array();

$db_connection = getDBConnection();
$course_name = $_SESSION['className'];
$sqlQuery = "select * from course_settings where course like '$course_name'";
$result = $db_connection->query($sqlQuery);
while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $num_ta_teaching = $recordArray['num_ta_teaching'];
    $num_ta_grading = $recordArray['num_ta_grading'];
    $chosen_ta_grading = $recordArray['chosen_ta_grading'];
    $chosen_ta_teaching = $recordArray['chosen_ta_teaching'];
}

$needed_teaching = $num_ta_teaching - $chosen_ta_teaching;
$needed_grading = $num_ta_grading - $chosen_ta_grading;

$sqlQuery2 = "select directory_id from preferred_courses where course like '$course_name'";
$result2 = $db_connection->query($sqlQuery2);
while ($recordArray = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $all_students_array[] = $recordArray['directory_id'];
}

foreach($all_students_array as $key){
    $sqlQuery3 = "select directory_id, can_teach, prefers_teach from applicants where directory_id = '$key'";
    $result3 = $db_connection->query($sqlQuery3);
    while ($recordArray = mysqli_fetch_array($result3, MYSQLI_ASSOC)){
        if($recordArray['can_teach'] == 1 && $recordArray['prefers_teach'] == 1){
            $teaching_array[] = $recordArray['directory_id'];
        }
        else{
            $grading_array[] = $recordArray['directory_id'];
        }
    }
}
if(count($teaching_array) > 0 && count($grading_array) > 0){

    if(count($teaching_array) < $needed_teaching){
        $teaching_max = count($teaching_array);
    }
    else{
        $teaching_max = $needed_teaching;
    }

    if(count($grading_array) < $needed_grading){
        $grading_max = count($grading_array);
    }
    else{
        $grading_max = $needed_grading;
    }

    $index = 0;
    $index2 = 0;
    $randomStudArrTeaching = array();
    $randomStudArrGrading = array();
    while($index < $teaching_max){

        if(count($teaching_array) == 1){
            $rand = 0;
        }
        else{
            $rand = rand(0, count($teaching_array) - 1);
        }
        if(!in_array($rand, $randomStudArrTeaching)){
            $randomStudArrTeaching[] = $rand;
            $index++;
        }
    }


    while($index2 < $grading_max){
        if(count($grading_array) == 1){
            $rand = 0;
        }
        else{
            $rand = rand(0, count($grading_array) - 1);
        }
        if(!in_array($rand, $randomStudArrGrading)){
            $randomStudArrGrading[] = $rand;
            $index2++;
        }
    }

    for($ind = 0; $ind < count($teaching_array); $ind++){
        if(in_array($ind, $randomStudArrTeaching)){
            $final_teaching_array[] = $teaching_array[$ind];
        }
    }

    for($ind = 0; $ind < count($grading_array); $ind++){
        if(in_array($ind, $randomStudArrGrading)){
            $final_grading_array[] = $grading_array[$ind];
        }
    }
}
else{
    $bottomPart = "<h1>Sorry, No Students To Add</h1>";
}

if(isset($_POST["viewTeaching"])) {
    $_SESSION['teachingArray'] = $final_teaching_array;
    header("Location: adminViewTeaching.php");
}
if(isset($_POST["viewGrading"])) {
    $_SESSION['gradingArray'] = $final_grading_array;
    header("Location: adminViewGrading.php");
}


$topPart = <<<EOBODY
        <div class="form-horizontal" >
             <form action="{$_SERVER["PHP_SELF"]}" method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="form-group">
                        Teaching TA's Have Been Successfully Updated: <input type="submit" class="btn btn-info" value="View Here" name="viewTeaching" class="form-control">
                    </div>
                    <div class="form-group">
                        Grading TA's Have Been Successfully Updated: <input type="submit" class="btn btn-info" value="View Here" name="viewGrading" class="form-control">
                    </div>
                </div>
            </form>    
            <a href="adminHome.php" class="btn btn-info">Home</a> 
        </div>
EOBODY;

require_once("bootstrap.php");
    if($bottomPart != ""){
        $body = $bottomPart;
    }
    else{
        $body = $topPart;
    }
    
    $page = generatePage($body);
    echo $page;
?>