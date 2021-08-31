<?php

    $dbConn = new mysqli("localhost", "TWA_student", "TWA_2021_Autumn", "electrical");

    if($dbConn->connect_error) {
        die("Failed to connect to database " . $dbConn->connect_error);
    }
?>
