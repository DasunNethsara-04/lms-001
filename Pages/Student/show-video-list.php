<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Student") {

    include("../../connection/conn.php");
    $course_id = $_GET['course_id'];
    $student_email = $_SESSION['email'];
    $course_name = $_GET['course_name'];


    $sql2 = "SELECT
                lt.lesson_id,
                lt.lesson_number,
                lt.lesson_url,
                lt.course_id,
                lt.lesson_name,
                slp.watched_status
            FROM
                lesson_tbl lt
            LEFT JOIN
                (
                    SELECT enroll_id, lesson_id, watched_status
                    FROM student_lesson_progress_tbl
                    WHERE enroll_id IN (SELECT enroll_id FROM student_enroll_tbl WHERE student_id = (SELECT student_id FROM student_tbl WHERE email = '$student_email'))
                ) slp ON lt.lesson_id = slp.lesson_id
            WHERE
                lt.course_id = $course_id

";
    $result2 = $conn->query($sql2);
    $data = $result2->fetch_all();
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
            <?php echo htmlspecialchars($course_name); ?> | Techසර LK
        </title>

    </head>

    <body class="sb-nav-fixed">
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h2 class="mt-3">
                    <?= $course_name ?>
                </h2>

                <?php
                $sql3 = "SELECT
                            COUNT(DISTINCT lt.lesson_id) AS total_available_lessons,
                            COUNT(DISTINCT slp.lesson_id) AS total_watched_lessons
                        FROM
                            lesson_tbl lt
                        LEFT JOIN
                            student_lesson_progress_tbl slp ON lt.lesson_id = slp.lesson_id AND slp.enroll_id IN (SELECT enroll_id FROM student_enroll_tbl WHERE student_id = (SELECT student_id FROM student_tbl WHERE email = '$student_email') AND course_id = $course_id)
                        WHERE
                            lt.course_id = $course_id;
";
                $result3 = $conn->query($sql3);
                $vid_data = $result3->fetch_assoc();
                $total_available = $vid_data["total_available_lessons"];
                $total_watched = $vid_data["total_watched_lessons"];
                $percentage = round(($total_watched / $total_available) * 100, 0);
                ?>

                <div class="container">
                    <h3 class="mt-3 text-center">Your Progress</h3>
                    <div class="progress" role="progressbar" aria-label="Animated striped example"
                        aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            style="width: <?= $percentage ?>%">
                            <?= $percentage ?>%
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Lesson Number</th>
                                <th>Lesson Name</th>
                                <th>Operations</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $d) {
                                $lesson_number = $d[1];
                                $lesson_name = $d[4];
                                $lesson_url = $d[2];
                                // $enroll_id = $d[];
                                $lesson_status = ($d[5] == null) ? "Not Watched" : "Watched";
                                ?>
                                <tr>
                                    <th>
                                        <?= $lesson_number ?>
                                    </th>
                                    <td>
                                        <a href="./show-video-lesson.php?url=<?= $lesson_url ?>&lesson_number=<?= $lesson_number ?>&status=<?= $lesson_status ?>&lesson_name=<?= $lesson_name ?>&course_name=<?= $course_name ?>&course_id=<?= $course_id ?>"
                                            style="text-decoration: none; color: black;">
                                            <?= $lesson_name ?>
                                        </a>
                                    </td>
                                    <td><a href="../../data/change-video-progress.php?course_id=<?= $course_id ?>&student_email=<?= $student_email ?>&lesson_number=<?= $lesson_number ?>&course_name=<?= $course_name ?>"
                                            class="btn btn-info btn-sm <?= ($lesson_status == "Watched") ? "disabled" : "" ?>">Mark
                                            as
                                            Done</a></td>
                                    <td>
                                        <?php
                                        if ($lesson_status == "Not Watched") {
                                            ?>
                                            <i class="fa-solid fa-square-xmark fa-2x" style="color: red;" title="Not Watched"></i>
                                            <?php
                                        } else {
                                            ?>
                                            <i class="fa-solid fa-square-check fa-2x" style="color: green;" title="Watched"></i>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>



            <!-- footer -->
            <?php
            include '../footer.php';
            ?>
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