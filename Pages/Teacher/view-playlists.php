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
    </head>

    <body class="sb-nav-fixed">
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <!-- Content -->
                <div class="container-fluid">
                    <h1 class="mt-4">All Playlists</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Videos</th>
                                <th scope="col">Status</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Enrolled Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../../connection/conn.php");
                            $sql1 = "SELECT c.course_name, COUNT(l.lesson_id) AS num_lessons, CONCAT(t.title, ' ', t.first_name, ' ', t.last_name) AS teacher_name, COUNT(se.student_id) AS num_students FROM course_tbl c LEFT JOIN lesson_tbl l ON c.course_id = l.course_id LEFT JOIN teacher_tbl t ON c.teacher_id = t.teacher_id LEFT JOIN student_enroll_tbl se ON l.lesson_id = se.lesson_id GROUP BY c.course_id, c.course_name, t.title, t.first_name, t.last_name;";
                            $result1 = $conn->query($sql1);
                            if ($result->num_rows > 0) {
                                // have some playlists
                                while ($row1 = $result1->fetch_assoc()) {
                                    $crs_name = $row1["course_name"];
                                    $crs_videos = $row1["num_lessons"];
                                    $teacher_name = $row1["teacher_name"];
                                    $num_students = $row1["num_students"];

                                    $sql2 = "SELECT ";

                                ?>
                                    <tr>
                                        <td><?=$crs_name?></td>
                                        <td><?=$crs_videos?></td>
                                        <td><?php
                                                if($crs_videos > 0) {
                                                    ?>
                                                    <span class="badge rounded-pill text-bg-success">Available</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="badge rounded-pill text-bg-warning">Comming Soon</span>
                                                    <?php
                                                }
                                            ?></td>
                                        <td><?=$teacher_name?></td>
                                        <td><?= $num_students ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                // no playlists
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    There are no any playlists created!
                                </div>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

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
}
?>