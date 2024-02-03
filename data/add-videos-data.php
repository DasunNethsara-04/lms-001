<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../connection/conn.php");
    $lesson_number = $_POST['lesson_no'];
    $lesson_name = $_POST['lesson_name'];
    $course_id = $_POST['course_id'];
    $lesson_url = $_POST['lesson_url'];

    $stmt = $conn->prepare("SELECT * FROM lesson_tbl WHERE (lesson_name=? OR lesson_url=?) AND course_id=?");
    $stmt->bind_param("ssi", $lesson_name, $lesson_url, $course_id);
    $stmt->execute();
    $result = $stmt->get_result(); // Use get_result to fetch the result set
    $stmt->close(); // Move this line here

    if ($result->num_rows < 1) {
        $stmt = $conn->prepare("INSERT INTO lesson_tbl (lesson_number, lesson_url, course_id, lesson_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $lesson_number, $lesson_url, $course_id, $lesson_name);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        $conn->close();

        if ($result > 0) {
            // success message
            $success_message = "New Video Added!";
            $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../Pages/Teacher/add-videos.php?success=$success_message");
            exit();
        } else {
            // error
            $error_message = "Error adding new video!";
            $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../Pages/Teacher/add-videos.php?error=$error_message");
            exit();
        }
    } else {
        // Video already exists
        $error_message = "$lesson_name Already exists";
        $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../Pages/Teacher/add-videos.php?error=$error_message");
        exit();
    }
}

?>