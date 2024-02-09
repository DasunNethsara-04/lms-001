<?php
include("../connection/conn.php");

$cid = $_GET['comment_id'];
$sql1 = "DELETE FROM comments_tbl WHERE comment_id=$cid";
$result1 = $conn->query($sql1);
if ($result1) {
    // deleted
    $success_message = "Message Deleted Successfully!";
    header("Location: ../Pages/Teacher/review-messages.php?success=$success_message");
    exit();
} else {
    $error_message = "Error Deleting the Message";
    header("Location: ../Pages/Teacher/review-messages.php?error=$error_message");
    exit();
}

?>