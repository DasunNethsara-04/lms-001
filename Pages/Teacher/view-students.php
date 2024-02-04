<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Teacher") {
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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../styles/styles.css">
        <title>All Students | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <!-- Content -->
                <div class="container-fluid">
                    <h1 class="mt-4">All Students</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>

                    <?php if (isset($_GET['success'])) { ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Done',
                                text: "<?= $_GET['success'] ?>"
                            })
                        </script>
                    <?php } ?>

                    <?php if (isset($_GET['error'])) { ?>
                        <script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: "<?= $_GET['error'] ?>"
                            })
                        </script>
                    <?php } ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Following</th>
                                <th scope="col">Completed</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT student_id, first_name, last_name, email, status FROM student_tbl";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $std_id = $row["student_id"];
                                $name = $row['first_name'] . " " . $row["last_name"];
                                $email = $row["email"];
                                $status = $row["status"];

                                ?>
                                <tr>
                                    <td>
                                        <?= $name ?>
                                    </td>
                                    <td>
                                        <?= $email ?>
                                    </td>
                                    <?php
                                    if ($status) {
                                        ?>
                                        <td><span class="badge rounded-pill text-bg-success">Active</span></td>
                                        <?php
                                    } else {
                                        ?>
                                        <td><span class="badge rounded-pill text-bg-danger">Inactive</span></td>
                                        <?php
                                    }
                                    ?>
                                    <td>N/A</td>
                                    <td>N/A</td>

                                    <td>
                                        <a class="btn btn-success btn-sm" name="profile"
                                            href="./view-student-profile.php?student_id=<?= $std_id ?>">Profile</a>
                                        <?php
                                        if ($status) {
                                            ?>
                                            <a class="btn btn-warning btn-sm" name="deactive"
                                                href="../../data/change-student-state.php?student_id=<?= $std_id ?>&cur_state=<?= $status ?>">Deactivate</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a class="btn btn-info btn-sm" name="active"
                                                href="../../data/change-student-state.php?student_id=<?= $std_id ?>&cur_state=<?= $status ?>">Activate</a>
                                            <?php
                                        }
                                        ?>

                                        <button class="btn btn-danger btn-sm delete-btn" data-student-id="<?= $std_id ?>"
                                            name="delete">Delete</button>
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
            <?php include '../footer.php'; ?>
        </div>
        </div>

        <script>
            function logout() {
                window.location.href = "../../includes/logout.php";
            }
            // ../../data/delete-student-data.php
            document.addEventListener('DOMContentLoaded', function () {
                // Attach event listeners to delete buttons
                const deleteButtons = document.querySelectorAll('.delete-btn');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const studentId = this.getAttribute('data-student-id');

                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Perform AJAX request to delete_student.php
                                fetch('../../data/delete-student-data.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: 'student_id=' + encodeURIComponent(studentId),
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: data.message,
                                                icon: "success"
                                            });

                                            // Reload the page after a short delay
                                            setTimeout(function () {
                                                location.reload();
                                            }, 800);
                                        } else {
                                            Swal.fire({
                                                title: "Error!",
                                                text: data.message,
                                                icon: "error"
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }
                        });
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
    $conn->close();
}
?>