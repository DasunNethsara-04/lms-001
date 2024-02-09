<?php
include("../connection/conn.php");

$to_change = $_GET['status'];
$cid = $_GET['comment_id'];
$sql1 = "UPDATE comments_tbl SET status=? WHERE comment_id=?";
$stmt = $conn->prepare($sql1);
$stmt->bind_param("ii", $to_change, $cid);
$stmt->execute();
$res = $stmt->affected_rows;
// Close the statement and connection
$stmt->close();
$conn->close();
if ($res == 1) {
    // Successful update
    $success_message = "Message Status Updated Successfully!";
    header("Location: ../Pages/Teacher/review-messages.php?success=$success_message");
    exit();
} else {
    $error_message = "Error Updating the Status";
    header("Location: ../Pages/Teacher/review-messages.php?error=$error_message");
    exit();
}




?>