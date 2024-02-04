<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../connection/conn.php");

    // normal text and drop down fields data
    $course_name = $_POST["course_name"];
    $course_type = $_POST["course_type"];
    $teacher_id = $_POST["teacher_id"];

    // Validate and sanitize inputs
    $course_name = filter_var($course_name, FILTER_SANITIZE_STRING);

    // Check for HTML tags or special characters in first name and last name
    if ($course_name !== $_POST["course_name"]) {
        // Handle input with special characters
        $error_message = "Invalid characters in Course name";
        $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
        header("Location: ../Pages/Teacher/add-playlist.php?error=$error_message");
        exit();
    }

    // image data
    $name = $_FILES['course_pic']['name'];
    $type = $_FILES['course_pic']['type'];
    $error = $_FILES['course_pic']['error'];

    if (!file_exists("../uploads")) {
        mkdir("../uploads", 0777, true);
    }

    if ($error > 0) {
        // no image selected
        $stmt = $conn->prepare("SELECT * FROM course_tbl WHERE course_name=? AND course_type_id=? AND teacher_id=?");
        $stmt->bind_param("sii", $course_name, $course_type, $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows < 1) {
            $stmt = $conn->prepare("INSERT INTO course_tbl (course_name, course_type_id, teacher_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $course_name, $course_type, $teacher_id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $stmt->close();
            if ($result > 0) {
                $success_message = "New Playlist Added!";
                $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
                header("Location: ../Pages/Teacher/add-playlist.php?success=$success_message");
                exit();
            } else {
                $error_message = "Error found";
                $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                header("Location: ../Pages/Teacher/add-playlist.php?error=$error_message");
                exit();
            }
        } else {
            $error_message = "Playlist $course_name already exists!";
            $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
            header("Location: ../Pages/Teacher/add-playlist.php?error=$error_message");
            exit();
        }
    } else {
        // image selected
        // with profile pic
        $temp2 = explode(".", $name);
        $filename = "../uploads/" . explode(".", $course_name)[0] . "." . $temp2[1];

        // resize the image
        if ($type == 'image/jpeg' || $type == 'image/png') {
            // Get the file size
            $file_size = $_FILES['course_pic']['size'];

            // Get the temporary file name
            $tmp_name = $_FILES['course_pic']['tmp_name'];

            // Set the maximum file size (in bytes)
            $max_size = 2000000;
            if ($file_size <= $max_size) {
                // Set the new width and height 
                $new_width = 320;
                $new_height = 320;
                // Get the original image dimensions 
                list($width, $height) = getimagesize($tmp_name);
                // Create a new image with the new dimensions 
                $new_image = imagecreatetruecolor($new_width, $new_height);
                // Load the original image
                if ($type == 'image/jpeg') {
                    $original_image = imagecreatefromjpeg($tmp_name);
                } else {
                    $original_image = imagecreatefrompng($tmp_name);
                }
                // Resize the original image to the new dimensions
                imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                // Save the new image 
                if ($type == 'image/jpeg') {
                    imagejpeg($new_image, $filename);
                } else {
                    imagepng($new_image, $filename);
                }
                // Free up memory 
                imagedestroy($original_image);
                imagedestroy($new_image);
                // Display a success message 
            }

            $stmt = $conn->prepare("SELECT * FROM course_tbl WHERE course_name=? AND course_type_id=? AND teacher_id=?");
            $stmt->bind_param("sii", $course_name, $course_type, $teacher_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows < 1) {
                $stmt = $conn->prepare("INSERT INTO course_tbl (course_name, course_type_id, teacher_id, course_pic) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("siis", $course_name, $course_type, $teacher_id, $filename);
                $stmt->execute();
                $result = $stmt->affected_rows;
                $stmt->close();
                if ($result > 0) {
                    $success_message = "New Playlist Added!";
                    $success_message = htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');
                    header("Location: ../Pages/Teacher/add-playlist.php?success=$success_message");
                    exit();
                } else {
                    $error_message = "Error found";
                    $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                    header("Location: ../Pages/Teacher/add-playlist.php?error=$error_message");
                    exit();
                }
            } else {
                $error_message = "Playlist $course_name already exists!";
                $error_message = htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');
                header("Location: ../Pages/Teacher/add-playlist.php?error=$error_message");
                exit();
            }

        }
    }
}

$conn->close();

?>