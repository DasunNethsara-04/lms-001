<?php

// initializing the connection to database
$host = "localhost";  // server ip
$username = "root";   // server username
$password = "";       // password
$dbname = "lms";      // database name


// creating the mysqli connection object
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Error" . $conn->connect_error);
}

?>