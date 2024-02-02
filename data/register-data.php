<?php
include("../connection/conn.php");

function containsScript($input)
{
    // Check if the input contains script tags or potentially harmful content
    $pattern = "/<script|<\/script|<\?php|<\?|eval\(|system\(|exec\(|passthru\(|shell_exec\(|popen\(|proc_open\(/i";
    return preg_match($pattern, $input);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize inputs
    $fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // Check for HTML tags or special characters in first name and last name
    if ($fname !== $_POST["fname"] || $lname !== $_POST["lname"]) {
        // Handle input with special characters
        $error_message = "Invalid characters in first name or last name";
        $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../register.php?error=$error_message");
        exit();
    }

    if ($email === false) {
        // Handle invalid email address
        $error_message = "Invalid email address";
        $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../register.php?error=$error_message");
        exit();
    }

    // Check if the password contains script tags or potentially harmful content
    if (containsScript($password)) {
        // Handle input with script tags
        $error_message = "Invalid characters in password";
        $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../register.php?error=$error_message");
        exit();
    }

    // Hashing the password securely
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists using parameterized query
    $stmt = $conn->prepare("SELECT * FROM student_tbl WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 0) {
        // Add student using parameterized query
        $current_date = date("Y-m-d");
        $state = 1;
        $insertStmt = $conn->prepare("INSERT INTO student_tbl (first_name, last_name, email, password, date_added, status) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssssi", $fname, $lname, $email, $hashed_pwd, $current_date, $state);
        $insertStmt->execute();

        if ($insertStmt->affected_rows > 0) {
            $success_message = "Registration Success! Now you can login";
            $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../login.php?success=$success_message");
            exit();
        } else {
            $error_message = "Error Found!";
            $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../register.php?error=$error_message");
            exit();
        }
    } else {
        // Already exists
        $warning_message = "$email Already exists!";
        $warning_message = htmlspecialchars($warning_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../register.php?warning=$warning_message");
        exit();
    }
}
$conn->close();
?>