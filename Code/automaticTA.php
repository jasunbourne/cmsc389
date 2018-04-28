<?php 
    require_once "support.php";
    require_once "dbLogin.php";


    /* Connecting to the database */        
    $db_connection = new mysqli($host, $user, $password, $database);
    if ($db_connection->connect_error) {
        die($db_connection->connect_error);
    }

    session_start();
    $sel = $_SESSION['classChoice'];
    $sql = "";

    $sql = "SELECT directory_id FROM classes where course like '$sel'";

    $result = $db_connection->query($sql);
    $array = $_SESSION['arr'];
    $table = '<div class="container-fluid"><table class="table table-bordered table-striped table-hover table-condensed text-center">';
    $table .= "<thead>";
    foreach ($array as $key) {
        $table .= '<th class="text-center">'.$key."</th>";
    }
    $table .= "</thead>";


    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $table .= "<tr>";
            foreach($array as $key1){
                $table .= "<td>".$row[$key1]."</td>";
            }
            $table .= "</tr>";
        }
    } 
    $table .= "</table></div>";
    if(isset($_POST["back"])) {
        header("Location: main.html");
    }


$topPart = <<<EOBODY
        <div class="form-horizontal" >
             <form action="{$_SERVER["PHP_SELF"]}" method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-push-3">
                        <input type="submit" value="Back To Main Menu" name="back" class="form-control">
                    </div>
                </div>
            </form>     
        </div>
EOBODY;

    require_once "bootstrap.php";
    $body = $table.$topPart;
    
    $page = generatePage($body);
    echo $page;
?>