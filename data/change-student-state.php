<?php
include("../connection/conn.php");
$student_id = $_GET['student_id'];
$status = ($_GET['cur_state'] == 1) ? 0 : 1;
$sql = "UPDATE student_tbl SET status='$status' WHERE student_id='$student_id'";

if ($conn->query($sql)) {
    $conn->close();
    // done
    if ($status == 0) {
        $success_message = "Student Deactivated";
        $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../Pages/Teacher/view-students.php?success=$success_message");
        exit();
    } else {
        $success_message = "Student Activated";
        $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../Pages/Teacher/view-students.php?success=$success_message");
        exit();
    }

} else {
    // error
    $error_message = "Error Found";
    $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
    header("Location: ../Pages/Teacher/view-students.php?error=$error_message");
    exit();
}

?>