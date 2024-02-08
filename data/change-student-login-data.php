<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../connection/conn.php");
    $cur_email = $_GET['cur_email'];
    $op = $_GET['op'];

    if ($op == 1) {
        // email only
        if ($_POST['email'] != "") {
            $new_email = $_POST['email'];
            $stmt1 = $conn->prepare("UPDATE student_tbl SET email=? WHERE email=?");
            $stmt1->bind_param("ss", $new_email, $cur_email);
            $stmt1->execute();
            if ($stmt1->affected_rows > 0) {
                // success
                $success_message = "Email Updated! Now you must log out from the site and log again.";
                $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
                header("Location: ../Pages/Student/settings.php?success=$success_message");
                exit();
            } else {
                // updation error
                $error_message = "Data Updating faild";
                $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                header("Location: ../Pages/Student/settings.php?error=$error_message");
                exit();
            }
        } else {
            // all fields are required
            $warning_message = "Email field can not be empty";
            $warning_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../Pages/Student/settings.php?warning=$warning_message");
            exit();
        }

    } else {
        // password only
        if ($_POST['old_pwd'] != "" && $_POST['new_pwd'] != "" && $_POST['confirmed_new_pwd'] != "") {
            $old_pwd = $_POST['old_pwd'];
            $new_pwd = $_POST['new_pwd'];
            $confirmed_pwd = $_POST['confirmed_new_pwd'];


            $status = 1;
            $stmt1 = $conn->prepare("SELECT password FROM student_tbl WHERE email= ? AND status= ?");
            $stmt1->bind_param("si", $cur_email, $status);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            $o_pwd = $result1->fetch_assoc()["password"];
            if (password_verify($old_pwd, $o_pwd)) {
                if ($new_pwd == $confirmed_pwd) {
                    $hashed_password = password_hash($new_pwd, PASSWORD_DEFAULT);
                    $stmt2 = $conn->prepare("UPDATE student_tbl SET password=? WHERE email=?");
                    $stmt2->bind_param("ss", $hashed_password, $cur_email);
                    $stmt2->execute();
                    if ($stmt2->affected_rows == 1) {
                        // success
                        $success_message = "Password Updated! Now you must log out from the site and log again.";
                        header("Location: ../Pages/Student/settings.php?success=$success_message");
                        exit();
                    } else {
                        // updation error
                        $error_message = "Data Updating faild";
                        header("Location: ../Pages/Student/settings.php?error=$error_message");
                        exit();
                    }
                } else {
                    // password does not match
                    $warning_message = "New and Confirmation Email Passwords are not matching!";
                    header("Location: ../Pages/Student/settings.php?warning=$warning_message");
                    exit();
                }

            } else {
                // password does not match
                $warning_message = "Incorrect Old Password";
                header("Location: ../Pages/Student/settings.php?warning=$warning_message");
                exit();
            }


        } else {
            // all fields are required
            $warning_message = "All fields are required";
            header("Location: ../Pages/Student/settings.php?warning=$warning_message");
            exit();

        }

    }

}
?>