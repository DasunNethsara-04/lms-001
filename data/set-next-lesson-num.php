<?php

include("../connection/conn.php");
$course_id = $_POST['course_id'];

$sql = "SELECT COALESCE(COUNT(lesson_number), 0) AS latest_lesson_number FROM lesson_tbl WHERE course_id='$course_id' ORDER BY lesson_number DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row['latest_lesson_number'] + 1;

$conn->close();
?>