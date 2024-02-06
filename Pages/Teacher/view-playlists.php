<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Teacher") {
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
        <title>All Playlists | Techසර LK</title>
        <style>
            .card {
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid rgba(0, 0, 0, .125);
                border-radius: .25rem;
            }

            .card-body {
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1rem;
            }
        </style>
    </head>

    <body class="sb-nav-fixed">
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <!-- Content -->
            <div class="container-fluid">
                <h1 class="mt-4">All Playlists</h1>
                <div class="row mt-4">
                    <?php
                    include("../../connection/conn.php");
                    $sql1 = "SELECT
                            c.course_id,
                            c.course_name,
                            c.course_pic,
                            c.course_type_id,
                            COUNT(l.lesson_id) AS num_lessons,
                            CONCAT(t.title, ' ', t.first_name, ' ', t.last_name) AS teacher_name,
                            COUNT(se.student_id) AS num_students
                        FROM
                            course_tbl c
                        LEFT JOIN
                            lesson_tbl l ON c.course_id = l.course_id
                        LEFT JOIN
                            teacher_tbl t ON c.teacher_id = t.teacher_id
                        LEFT JOIN
                            student_enroll_tbl se ON c.course_id = se.course_id
                        GROUP BY
                            c.course_id, c.course_name, t.title, t.first_name, t.last_name;";
                    $result1 = $conn->query($sql1);
                    if ($result->num_rows > 0) {
                        // have some playlists
                        while ($row1 = $result1->fetch_assoc()) {
                            $crs_name = $row1["course_name"];
                            $crs_videos = $row1["num_lessons"];
                            $teacher_name = $row1["teacher_name"];
                            $num_students = $row1["num_students"];
                            $course_pic = $row1["course_pic"];
                            $course_topic_id = $row1["course_type_id"];

                            $sql2 = "SELECT course_type_name FROM course_type_tbl WHERE course_type_id='$course_topic_id'";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            $course_type_name = $row2["course_type_name"];


                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="../<?= $course_pic ?>" alt="<?= $course_name ?>" class="rounded-circle"
                                                width="100">
                                            <div class="mt-3">
                                                <h4>
                                                    <?= $crs_name ?>
                                                </h4>
                                                <p class="text-secondary mb-1">Topic: <span class="badge rounded-pill text-bg-info">
                                                        <?= $course_type_name ?>
                                                    </span></p>
                                                <p class="text-muted font-size-sm">Teacher: <b>
                                                        <?= $teacher_name ?>
                                                    </b></p>
                                                <p class="text-muted font-size-sm">Videos: <b>
                                                        <?= $crs_videos ?>
                                                    </b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
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
}
?>