<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstarp CSS cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Register | Techසර LK</title>
</head>

<body>
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="./src/imgs/img2.webp"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                <?php if (isset($_GET['error'])) { ?>
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: "<?= $_GET['error'] ?>"
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
                                    <form action="./data/register-data.php" method="post">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                        </div>

                                        <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register Now...</h4>

                                        <div class="row mb-4">
                                            <div class="col">
                                            <div data-mdb-input-init class="form-outline">
                                                <label class="form-label" for="form3Example1">First name</label>
                                                <input type="text" id="form3Example1" class="form-control" name="fname" required />
                                            </div>
                                            </div>
                                            <div class="col">
                                            <div data-mdb-input-init class="form-outline">
                                                <label class="form-label" for="form3Example2">Last name</label>
                                                <input type="text" id="form3Example2" class="form-control" name="lname" required />
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input type="email" id="form2Example17"
                                                class="form-control" name="email" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" id="form2Example27"
                                                class="form-control" name="password" required />
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <!-- <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button> -->
                                            <input type="submit" value="Register" name="register" class="btn btn-dark btn-lg btn-block" />
                                            <button class="btn btn-link" onclick="redirectToLog()">I have an account</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function redirectToLog() {
            window.location.href = "./login.php";
        }
    </script>
    <!-- Bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>