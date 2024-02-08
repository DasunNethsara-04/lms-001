<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../connection/conn.php");


    if ($_POST['fname'] != "" || $_POST['lname']) {
        // fetching the data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $updated = date("Y-m-d");

        $stmt = $conn->prepare("UPDATE teacher_tbl SET first_name= ?, last_name= ?, date_updated= ? WHERE email=?");
        $stmt->bind_param("ssss", $fname, $lname, $updated, $email);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        $conn->close();
        if ($result > 0) {
            // success
            $success_message = "Teacher Info Updated!";
            $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../Pages/Teacher/teacher-profile.php?success=$success_message");
            exit();
        } else {
            // Updation error
            $error_message = "Data Updating faild";
            $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../Pages/Teacher/teacher-profile.php?error=$error_message");
            exit();
        }

    } else {
        // no first name or last name
        $warning_message = "All Fields are required!";
        $warning_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../Pages/Teacher/teacher-profile.php?warning=$warning_message");
        exit();
    }
}

?>