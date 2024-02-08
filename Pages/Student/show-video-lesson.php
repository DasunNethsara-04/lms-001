<?php
session_start();

if (isset($_SESSION["email"]) && $_SESSION["role"] == "Student") {
    include("../../connection/conn.php");
    $url = $_GET['url'];
    $lesson_number = $_GET['lesson_number'];
    $lesson_name = $_GET['lesson_name'];
    $status = $_GET['status'];
    $course_name = $_GET['course_name'];
    $course_id = $_GET['course_id'];
    $student_email = $_SESSION['email'];
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../styles/styles.css">
        <title>
            Course:
            <?= $course_name ?> | Techසර LK
        </title>
    </head>

    <body class="sb-nav-fixed">
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">

            <!-- content goes here. do not remove any code -->
            <div class="container-fluid">
                <div class="shadow p-3  mt-3 form-w mt-5">
                    <a class="btn btn-primary btn-sm"
                        href="./show-video-list.php?course_id=<?= $course_id ?>&course_name=<?= $course_name ?>">Go back to
                        Playlist</a>
                    <h2 class="mt-2">
                        <?= $lesson_name; ?>
                    </h2>

                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="mt-3 embed-responsive-item"
                            src="https://www.youtube.com/<?= $url ?>?rel=0&controls=0&modestbranding=1"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a class="btn btn-primary me-md-2 <?= ($status == "Watched") ? "disabled" : "" ?>"
                            href="../../data/change-video-progress.php?course_id=<?= $course_id ?>&student_email=<?= $student_email ?>&lesson_number=<?= $lesson_number ?>&course_name=<?= $course_name ?>"><i
                                class="fa-solid fa-check"></i> Mark as
                            Done</a>

                        <?php
                        $sql = "SELECT 
                                    next_lesson.lesson_url,
                                    next_lesson.lesson_number,
                                    next_lesson.lesson_name,
                                    slp.watched_status AS watched_status
                                FROM 
                                    lesson_tbl AS current_lesson
                                JOIN
                                    lesson_tbl AS next_lesson ON current_lesson.course_id = next_lesson.course_id
                                LEFT JOIN
                                    student_lesson_progress_tbl AS slp ON slp.lesson_id = next_lesson.lesson_id
                                LEFT JOIN
                                    student_enroll_tbl AS se ON se.course_id = current_lesson.course_id
                                WHERE 
                                    current_lesson.lesson_number = $lesson_number
                                    AND current_lesson.course_id = $course_id
                                    AND next_lesson.lesson_number > current_lesson.lesson_number
                                    AND next_lesson.course_id = current_lesson.course_id
                                    AND se.student_id = (SELECT student_id FROM student_tbl WHERE email = '$student_email') 
                                ORDER BY
                                    next_lesson.lesson_number ASC
                                LIMIT 1";

                        $result = $conn->query($sql);

                        if ($result) {
                            // Check if there are any rows returned
                            if ($result->num_rows > 0) {
                                // Fetch the row
                                $row = $result->fetch_assoc();

                                // Check if the fetched row is not null
                                if ($row !== null) {
                                    // Check if the expected columns exist in the row
                                    if (isset($row['lesson_url'], $row['lesson_number'], $row['lesson_name'])) {
                                        // Access the row elements
                                        $next_lesson_url = $row['lesson_url'];
                                        $next_lesson_number = $row['lesson_number'];
                                        $next_lesson_status = $row['watched_status'];
                                        $next_lesson_name = $row['lesson_name'];
                                        ?>
                                        <a class="btn btn-primary"
                                            href="show-video-lesson.php?url=<?= $next_lesson_url ?>&lesson_number=<?= $next_lesson_number ?>&status=<?= $next_lesson_status ?>&lesson_name=<?= $next_lesson_name ?>&course_name=<?= $course_name ?>&course_id=<?= $course_id ?>"><i
                                                class="fa-solid fa-arrow-right"></i>
                                            Next
                                            Lesson</a>
                                        <?php
                                    } else {
                                    }
                                } else {
                                    // Handle the case where no next lesson is found
                                    // echo "No next lesson found.";
                                    ?>
                                    <a class="btn btn-primary disabled"
                                        href="show-video-lesson.php?url=<?= $next_lesson_url ?>&lesson_number=<?= $next_lesson_number ?>&status=<?= $next_lesson_status ?>&lesson_name=<?= $next_lesson_name ?>&course_name=<?= $course_name ?>&course_id=<?= $course_id ?>"><i
                                            class="fa-solid fa-arrow-right"></i>
                                        Next
                                        Lesson</a>
                                    <?php
                                }
                            } else {
                                // Handle the case where the query returned no rows
                                // echo "No rows returned.";
                                ?>
                                <a class="btn btn-primary disabled"
                                    href="show-video-lesson.php?url=<?= $next_lesson_url ?>&lesson_number=<?= $next_lesson_number ?>&status=<?= $next_lesson_status ?>&lesson_name=<?= $next_lesson_name ?>&course_name=<?= $course_name ?>&course_id=<?= $course_id ?>"><i
                                        class="fa-solid fa-arrow-right"></i>
                                    Next
                                    Lesson</a>
                                <?php
                            }
                        } else {
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php include '../footer.php'; ?>
        </div>
        </div>


        <script>
            function logout() {
                window.location.href = "../../includes/logout.php";
            }
        </script>
        <script src="../../scripts/scripts.js"></script>
        <!-- Bootstrap js cdn -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>

    </body>

    </html>



    <?php
    $conn->close();
} else {
    header("Location: ../../login.php");
    exit();
}
?>