<?php
include("../connection/conn.php");
$course_id = $_GET['course_id'];
$student_email = $_GET['student_email'];
$lesson_number = $_GET['lesson_number'];
$course_name = $_GET['course_name'];

$sql1 = "SELECT
            se.enroll_id,
            lt.lesson_id
        FROM
            student_enroll_tbl se
        JOIN
            lesson_tbl lt ON se.course_id = lt.course_id
        JOIN
            student_tbl st ON se.student_id = st.student_id
        WHERE
            se.course_id = $course_id
            AND st.email = '$student_email'
            AND lt.lesson_number = $lesson_number;
        ";

$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$enroll_id = $row1["enroll_id"];
$lesson_id = $row1["lesson_id"];

$sql2 = "INSERT INTO student_lesson_progress_tbl (enroll_id, lesson_id, watched_status) VALUES ('$enroll_id', '$lesson_id', 'Watched')";
if ($conn->query($sql2)) {
    // success
    header("Location: ../Pages/Student/show-video-list.php?course_id=$course_id&course_name=$course_name");
    exit();
} else {
    // error
}


?>