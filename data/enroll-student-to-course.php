<?php

include("../connection/conn.php");
$course_id = $_GET['course_id'];
$student_email = $_GET['student_email'];
$course_name = $_GET['course_name'];

$sql1 = "SELECT student_id FROM student_tbl WHERE email='$student_email'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$student_id = $row1["student_id"];

$sql2 = "INSERT INTO student_enroll_tbl (student_id, course_id, enrollment_status) VALUES ('$student_id', '$course_id', 'Enrolled')";
if ($conn->query($sql2)) {
    header("Location: ../Pages/Student/show-video-list.php?course_id=$course_id&course_name=$course_name");
}
$conn->close();

?>