<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Student") {
    include("../../connection/conn.php");
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
        <link rel="stylesheet" href="../../styles/styles.css">
        <link rel="shortcut icon" href="../../src/imgs/logo.png" type="image/x-icon">
        <title>Your Comments | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">
        <?php include 'top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-4">Add a New Student</h1>

                <!-- Your further code goes here. keep coding in this div -->
                <div class="container mt-5"><?php if (isset($_GET['success'])) { ?>
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
                    

                    <form action="../../data/add-student-comment-data.php" method="post" class="shadow p-3 mt-5 form-w"
                        enctype='multipart/form-data'>
                        <h3>Fill all the Data</h3>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $_SESSION['email'] ?>" required
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message Type</label>
                            <select name="msg_type" id="course" class="form-select">
                                <option value="A suggestion">A Suggestion</option>
                                <option value="A comment">A Comment</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Message</label>
                            <textarea name="msg" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Send</button>
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
} else {
    header("Location: ../../login.php");
    exit();
}
?>