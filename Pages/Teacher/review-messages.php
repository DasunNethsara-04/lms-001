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
        <link rel="shortcut icon" href="../../src/imgs/logo.png" type="image/x-icon">
        <title>Show Messages for Review | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">
        <?php include 'top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <!-- Content -->
                <h2 class="mt-4">Select Message State</h2>

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

                <!-- 
                   status = 0  ->  "Comment Rejected"
                   status = 1  ->  "Comment Accepted"
                   status = 2  ->  "Pending" 
                -->

                <div class="container mt-5">
                    <div class="shadow p-3  mt-5 form-w">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <select name="" id="status" class="form-select">
                                        <option value="0">Rejected Messages</option>
                                        <option value="1">Accepted Messages</option>
                                        <option value="2">Pending Messages</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <button class="btn btn-success" id="search">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-5" id="resultTable">
                    <div class="shadow p-3  mt-5 form-w">
                        <h2 class="">Messages</h2>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Message Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody id="data"></tbody>
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

            $(document).ready(function () {
                $("#search").click(function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: "../../data/load-messages.php",
                        type: "POST",
                        data: {
                            status: $("#status option:selected").val()
                        },
                        success: function (data) {
                            $("#data").html(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log("Error: " + textStatus + " - " + errorThrown);
                        }
                    });
                });
            });
        </script>
        <script src="../../scripts/scripts.js"></script>
        <!-- Bootstrap js cdn -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>

    </body>

    </html>



    <?php
} else {

    header("Location: ../../login.php");
    exit();
}
?>