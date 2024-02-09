<?php
session_start();

if (isset($_SESSION["email"]) && $_SESSION["role"] == "Student") {

    function fetch_data($table_name)
    {
        include("../../connection/conn.php");
        $sql = "SELECT COUNT(*) AS num FROM $table_name";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['num'];
    }
    include("../../connection/conn.php");
    $std_email = $_SESSION['email'];
    $sql2 = "SELECT COUNT(*) AS enrolled, st.first_name FROM student_tbl st INNER JOIN student_enroll_tbl setl ON (st.student_id = setl.student_id) WHERE setl.enrollment_status='Enrolled' AND st.email='$std_email'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $num_of_enrolled = $row2["enrolled"];
    $fname = $row2['first_name'];

    // get the time and greeting message
    date_default_timezone_set('Asia/Colombo'); // time zone

    $currentTime = date("H");

    if ($currentTime < 12) {
        $msg = "Good Morning";
    } elseif ($currentTime < 18) {
        $msg = "Good Afternoon";
    } else {
        $msg = "Good Evening";
    }


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
        <link rel="shortcut icon" href="../../src/imgs/logo.png" type="image/x-icon">
        <title>Student Dashboard | Techසර LK</title>
        <style>
            .card-counter {
                box-shadow: 2px 2px 10px #dadada;
                margin: 5px;
                padding: 20px 10px;
                background-color: #fff;
                height: 100px;
                border-radius: 5px;
                transition: 0.3s linear all;
            }

            .card-counter:hover {
                box-shadow: 4px 4px 20px #dadada;
                transition: 0.3s linear all;
            }

            .card-counter.primary {
                background-color: #007bff;
                color: #fff;
            }

            .card-counter.danger {
                background-color: #ef5350;
                color: #fff;
            }

            .card-counter.success {
                background-color: #66bb6a;
                color: #fff;
            }

            .card-counter.info {
                background-color: #26c6da;
                color: #fff;
            }

            .card-counter .count-numbers {
                position: absolute;
                right: 35px;
                top: 20px;
                font-size: 32px;
                display: block;
            }

            .card-counter .count-name {
                position: absolute;
                right: 35px;
                top: 65px;
                font-style: italic;
                text-transform: capitalize;
                opacity: 0.5;
                display: block;
                font-size: 18px;
            }
        </style>
    </head>

    <body class="sb-nav-fixed">
        <?php include 'top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">

            <!-- content goes here. do not remove any code -->
            <div class="container-fluid">
                <h1 class="mt-3 text-primary display-6">Hi
                    <?= $fname ?>,
                    <?= $msg ?>!
                </h1>
                <h5 class="">Lets learn somthing new today!</h5>

                <div class="row mt-5">
                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i style="opacity: 0.4;" class="fa-solid fa-graduation-cap fa-4x"></i>
                            <span class="count-numbers">
                                <?= fetch_data("course_tbl") ?>
                            </span>
                            <span class="count-name">Total Courses</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter success">
                            <i style="opacity: 0.4;" class="fa-solid fa-book fa-4x"></i>
                            <span class="count-numbers">
                                <?= $num_of_enrolled ?>
                            </span>
                            <span class="count-name">Enrolled Courses</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter info">
                            <i style="opacity: 0.4;" class="fa-solid fa-video  fa-4x"></i>
                            <span class="count-numbers">
                                <?= fetch_data("lesson_tbl") ?>
                            </span>
                            <span class="count-name">Total Uploaded Videos</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h2>Courses Info</h2>
                    <div class="container mt-4">
                        <table class="table table-borderless table-fixed mt-3">
                            <?php
                            $sql1 = "SELECT course_name, course_id FROM course_tbl";
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0) {
                                $total_rows = $result1->num_rows;
                                while ($row1 = $result1->fetch_assoc()) {
                                    $course_id = $row1["course_id"];
                                    $course_name = $row1["course_name"];
                                    // $num_of_all_courses = $row1['c'];
                        
                                    $sql2 = "SELECT COUNT(*) AS num from student_tbl st INNER JOIN student_enroll_tbl setl ON (st.student_id = setl.student_id) INNER JOIN course_tbl ct ON (setl.course_id = ct.course_id) WHERE st.status = 1 AND ct.course_id=$course_id";
                                    $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch_assoc();
                                    $num = $row2["num"];
                                    ?>

                                    <tr>
                                        <th width="35%" title="Course Name">
                                            <?php
                                            $choices = array("primary", "warning", "danger", "info", "secondary", "success");
                                            // Get a random index from the $choices array
                                            $randomIndex = array_rand($choices);
                                            // Get the randomly selected class name
                                            $randomClassName = $choices[$randomIndex];
                                            ?>
                                            <i class="fa-solid fa-fire text-<?= $randomClassName ?>"></i>&nbsp;
                                            <?= $course_name ?>

                                        </th width="15%">
                                        <th title="Number of Student">
                                            <?= $num ?>
                                        </th>
                                        <td width="55%" title="Popularity">
                                            <div class="progress" role="progressbar" aria-label="Warning example"
                                                aria-valuenow="<?= round(($num / $total_rows) * 100, 0) ?>" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <div class="progress-bar text-bg-<?= $randomClassName ?>"
                                                    style="width: <?= round(($num / $total_rows) * 100, 0) ?>%"></div>
                                            </div>
                                        </td>
                                    </tr>



                                    <?php
                                }
                            }
                            ?>
                        </table>
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