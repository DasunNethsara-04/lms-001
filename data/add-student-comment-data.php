<?php

function containsScript($input)
{
    // Check if the input contains script tags or potentially harmful content
    $pattern = "/<script|<\/script|<\?php|<\?|eval\(|system\(|exec\(|passthru\(|shell_exec\(|popen\(|proc_open\(/i";
    return preg_match($pattern, $input);
}


include("../connection/conn.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['email'] != "" || $_POST['msg_type'] != "" || $_POST['msg'] != "") {
        $email = $_POST['email'];
        $msg_type = $_POST['msg_type'];
        $msg = $_POST['msg'];

        // Validate and sanitize inputs
        $msg = filter_var($msg, FILTER_SANITIZE_STRING);

        // Check for HTML tags or special characters in first name and last name
        if ($msg !== $_POST["msg"]) {
            // Handle input with special characters
            $warning_message = "Invalid characters in Your Message";
            header("Location: ../Pages/Student/add-comment.php?warning=$warning_message");
            exit();
        }

        if (containsScript($msg)) {
            // Handle input with script tags
            $warning_message = "Invalid characters in Message Box";
            header("Location: ../Pages/Student/add-comment.php?warning=$warning_message");
            exit();
        }

        // CURRENT DATE
        $cur_date = date("Y-m-d");
        $status = 1;

        $stmt1 = $conn->prepare("SELECT student_id FROM student_tbl WHERE email=? AND status=?");
        $stmt1->bind_param("si", $email, $status);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $stmt1->close();
        if ($result1->num_rows > 0) {
            $student_id = $result1->fetch_assoc()['student_id'];

            // status = 0  ->  "Comment Rejected"
            // status = 1  ->  "Comment Accepted"
            // status = 2  ->  "Pending"

            $status = 2;
            // INSERT QUERY
            $stmt2 = $conn->prepare("INSERT INTO comments_tbl (student_id, message_type,  message, date_added, status) VALUES (?, ?, ?, ?, ?)");
            $stmt2->bind_param("isssi", $student_id, $msg_type, $msg, $cur_date, $status);
            $stmt2->execute();
            $result2 = $stmt2->affected_rows;
            $stmt2->close();
            $conn->close();
            if ($result2) {
                // success
                $success_message = "Your Comment send for Admin Review!";
                header("Location: ../Pages/Student/add-comment.php?success=$success_message");
                exit();
            } else {
                // error: insertoin error
                $error_message = "Error Found while Insert the Message. Try Again!";
                header("Location: ../Pages/Student/add-comment.php?error=$error_message");
                exit();
            }
        } else {
            // no student
            $error_message = "No Student";
            header("Location: ../Pages/Student/add-comment.php?error=$error_message");
            exit();
        }

    } else {
        // error: all fields are required
        $warning_message = "All fields are required";
        header("Location: ../Pages/Student/add-comment.php?warning=$warning_message");
        exit();
    }
}

?>