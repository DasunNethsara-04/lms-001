<?php
include("../connection/conn.php");
session_start();


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    if ($role == "teacher") {
        $stmt = $conn->prepare("SELECT email, password FROM teacher_tbl WHERE email=?");
    } else {
        $stmt = $conn->prepare("SELECT email, password FROM student_tbl WHERE email=?");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $_SESSION['email'] = $user['email'];
            if ($role == "teacher") {
                $_SESSION["role"] = "Teacher";
                header("Location: ../Pages/Teacher/dashboard.php");
            } else {
                $_SESSION["role"] = "Student";
                header("Location: ../Pages/Student/dashboard.php");
            }
        } else {
            // Password is incorrect
            $em = "Incorrect Password";
            header("Location: ../login.php?error=$em");
            exit;
        }
    } else {
        // User not found
        $em = "User not found";
        header("Location: ../index.php?error=$em");
        exit;
    }

    $stmt->close();
}
$conn -> close();
?>