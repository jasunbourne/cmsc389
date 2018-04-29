<?php
    function getDBConnection() {
        $host = "localhost";
        $user = "student";
        $password = "goodbyeWorld";
        $database = "ta_applications";

        $db_connection = new mysqli($host, $user, $password, $database);
        if ($db_connection->connect_error) {
            die($db_connection->connect_error);
        }
        return $db_connection;
    }
?>