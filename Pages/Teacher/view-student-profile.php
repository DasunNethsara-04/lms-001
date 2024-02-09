<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Teacher") {
    include("../../connection/conn.php");
    $student_id = $_GET['student_id'];

    $sql = "SELECT * FROM student_tbl WHERE student_id='$student_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $student_name = $row["first_name"] . " " . $row['last_name'];
    $student_email = $row['email'];
    $date_joined = $row['date_added'];
    $date_updated = $row['date_updated'];
    $status = $row['status'];
    $conn->close();
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
        <title>Student Profile | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">
        <?php include 'top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <!-- Content -->
                <h1 class="mt-4">Profile</h1>

                <div class="container mt-3">
                    <form method="post" class="shadow p-3  mt-3 form-w">

                        <div class="container rounded bg-white mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Personal Info</h4>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Name</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly required
                                                    value="<?= $student_name ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Email</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly required
                                                    value="<?= $student_email ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Joined in</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly required
                                                    value="<?= $date_joined ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Last Updated in</label>
                                                <input type="text" class="form-control" autocomplete="off" readonly required
                                                    value="<?= ($date_updated == null) ? "N/A" : $date_updated ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Status</label>
                                                <?php
                                                if ($status) {
                                                    ?>
                                                    <span class="badge rounded-pill text-bg-success">Active</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <a class='btn btn-primary' href='view-students.php'>Go Back</a>
                                                <?php
                                                if ($status) {
                                                    ?>
                                                    <a class="btn btn-warning" name="deactive"
                                                        href="../../data/change-student-state.php?student_id=<?= $student_id ?>&cur_state=<?= $status ?>">Deactivate</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a class="btn btn-info" name="active"
                                                        href="../../data/change-student-state.php?student_id=<?= $student_id ?>&cur_state=<?= $status ?>">Activate</a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center experience mb-3">
                                            <h4 class="text-right">Learning Info</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div><br />


            <!-- footer -->
            <?php include '../footer.php'; ?>
        </div>
        </div>
    </body>

    </html>

    <?php
} else {
    header("Location: ../../login.php");
    exit();
}
?>