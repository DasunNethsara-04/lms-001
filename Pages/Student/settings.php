<?php
session_start();

if (isset($_SESSION["email"]) && $_SESSION["role"] == "Student") {
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
        <title>Settings | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">

        <?php include 'top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">

            <!-- content goes here. do not remove any code -->
            <div class="container-fluid">
                <h1 class="mt-4">Settings</h1>
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
                <!-- Your further code goes here. keep coding in this div -->
                <div class="container mt-3">
                    <!-- Login Info -->
                    <form action="../../data/change-student-login-data.php?cur_email=<?= $_SESSION['email'] ?>&op=1"
                        method="post" class="shadow p-3  mt-5 form-w">
                        <h3>Change Email</h3>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $_SESSION['email'] ?>"
                                autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-warning" name="change_pwd">Update</button>
                    </form>

                    <form action="../../data/change-student-login-data.php?cur_email=<?= $_SESSION['email'] ?>&op=2"
                        method="post" class="shadow p-3  mt-5 form-w">
                        <h3>Change Passoword</h3>
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="old_pwd" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Passowrd</label>
                            <div class="input-group mb-3">
                                <input type="text" name="new_pwd" class="form-control" id="passInput" required>
                                <button class="btn btn-secondary" id="gBTN">Random</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirmed_new_pwd" class="form-control" autocomplete="off"
                                required>
                        </div>
                        <button type="submit" class="btn btn-warning" name="change_pwd">Update</button>
                    </form>
                </div><br />

            </div>

            <!-- footer -->
            <?php include '../footer.php'; ?>
        </div>
        </div>
        <script>
            var gBTN = document.getElementById('gBTN');
            gBTN.addEventListener('click', function (e) {
                e.preventDefault();
                makePass(5)
            });

            function makePass(length) {
                let result = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const charactersLength = characters.length;
                let counter = 0;
                while (counter < length) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    counter += 1;
                }

                passInput.value = result;
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