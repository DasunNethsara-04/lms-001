<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Teacher") {

    function getData($table_name)
    {
        include("../../connection/conn.php");
        $sql = "SELECT COUNT(*) as count FROM $table_name";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
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
        <title>Teacher Dashboard | Techසර LK</title>
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
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Welcome back, <b>
                            <?= $_SESSION['role'] ?>
                        </b> !</li>
                </ol>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card-counter primary">
                            <!-- <i class="fa fa-code-fork"></i> -->
                            <i style="opacity: 0.4;" class="fa-solid fa-graduation-cap fa-4x"></i>
                            <span class="count-numbers">
                                <?= getData("student_tbl") ?>
                            </span>
                            <span class="count-name">Students</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <!-- <i class="fa fa-ticket fs-1"></i> -->
                            <i style="opacity: 0.4;" class="fa-solid fa-chalkboard-user fa-4x"></i>
                            <span class="count-numbers">
                                <?= getData("teacher_tbl") ?>
                            </span>
                            <span class="count-name">Teachers</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter success">
                            <!-- <i class="fa fa-database  fs-1"></i> -->
                            <i style="opacity: 0.4;" class="fa-solid fa-book fa-4x"></i>
                            <span class="count-numbers">
                                <?= getData("course_tbl") ?>
                            </span>
                            <span class="count-name">Courses</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter info">
                            <i style="opacity: 0.4;" class="fa-solid fa-video  fa-4x"></i>
                            <span class="count-numbers">
                                <?= getData("lesson_tbl") ?>
                            </span>
                            <span class="count-name">Total Videos</span>
                        </div>
                    </div>
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