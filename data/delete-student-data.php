<?php

include("../connection/conn.php");
if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $sql = "DELETE FROM student_tbl WHERE student_id='$student_id'";
    if ($conn->query($sql)) {
        // success
        $response = ['success' => true, 'message' => 'Student deleted successfully'];
    } else {
        // error
        $response = ['success' => false, 'message' => 'Error Found'];
    }
} else {
    $response = ['success' => false, 'message' => 'Invalid request'];
}

echo json_encode($response);

$conn->close();
?>