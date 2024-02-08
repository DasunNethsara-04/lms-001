<?php
session_start();

if (isset($_SESSION["email"]) && $_SESSION["role"] == "Student") {
    include("../../connection/conn.php");
    $sql = "SELECT * FROM student_tbl WHERE email='" . $_SESSION['email'] . "' AND status=1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $date_joined = $row['date_added'];
    $date_updated = $row['date_updated'];
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
        <title>Your Profile | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">

        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">

            <!-- content goes here. do not remove any code -->
            <div class="container-fluid">
                <h1 class="mt-4">Student Profile</h1>
                <ol class="breadcrumb mb-4">
                    <!-- <li class="breadcrumb-item active">Welcome back, <b> <?= $_SESSION['role'] ?> </b> !</li> -->
                </ol>

                <!-- Your further code goes here. keep coding in this div -->
                <div class="container mt-3">
                    <?php if (isset($_GET['success'])) { ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Done',
                                text: "<?= $_GET['success'] ?>"
                            })
                        </script>
                    <?php } ?>

                    <?php if (isset($_GET['warning'])) { ?>
                        <script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: "<?= $_GET['warning'] ?>"
                            })
                        </script>
                    <?php } ?>

                    <?php if (isset($_GET['error'])) { ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "<?= $_GET['error'] ?>"
                            })
                        </script>
                    <?php } ?>

                    <form method="post" class="shadow p-3  mt-3 form-w" action="../../data/update-student-data.php">
                        <div class="container rounded bg-white mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-3 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <img src="../../src/imgs/graduate.png" class="rounded-circle mt-5" width="250px"
                                            alt="profile picture" height="250px">
                                        <h4 class="font-weight-bold mt-3">
                                            <?= $first_name . " " . $last_name ?>
                                        </h4>
                                        <h6 class="text-black-50">Student</h6>
                                        <span> </span>
                                    </div>
                                </div>
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Personal Info</h4>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">First Name</label>
                                                <input type="text" class="form-control" name="fname" autocomplete="off"
                                                    required value="<?= $first_name ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Last Name</label>
                                                <input type="text" class="form-control" name="lname" autocomplete="off"
                                                    required value="<?= $last_name ?>">
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label class="labels">Email</label>
                                                <p class="form-text">(To update the email, you have to go to Settings page)
                                                </p>
                                                <input type="email" class="form-control" name="email" autocomplete="off"
                                                    readonly required value="<?= $_SESSION['email'] ?>">
                                            </div>
                                            <div class=" col-md-12 mt-3">
                                                <input type="submit" value="Edit Info" class="btn btn-warning btn-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center experience mb-3">
                                            <h4 class="text-right">System</h4>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Date of Joined</label>
                                            <input type="date" class="form-control" readonly autocomplete="off" required
                                                value="<?= $date_joined ?>">
                                        </div><br>
                                        <div class="col-md-12">
                                            <label class="form-label">Last Updated</label>
                                            <input type="date" class="form-control" readonly autocomplete="off" required
                                                value="<?= $date_updated ?>">
                                        </div><br>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div><br />

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