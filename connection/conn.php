<?php

    // initializing the connection to database
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lms";

    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection Error". $conn->connect_error);
    }