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
        <title>Add New Video | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">
        <?php include '../top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-4">Add a New Student</h1>

                <!-- Your further code goes here. keep coding in this div -->
                <div class="container mt-5">
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

                    <form action="../../data/add-videos-data.php" method="post" class="shadow p-3  mt-5 form-w"
                        enctype='multipart/form-data'>
                        <h3>Fill all the Data</h3>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" id="course" class="form-select">
                                <?php
                                $sql = "SELECT course_id, course_name FROM course_tbl";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['course_id'] ?>">
                                        <?= $row['course_name'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lesson Number</label>
                            <!-- <?php
                            $sql = "SELECT COALESCE(COUNT(lesson_number), 0) AS latest_lesson_number FROM lesson_tbl ORDER BY lesson_number DESC LIMIT 1";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $lesson_number = $row["latest_lesson_number"] + 1
                                ?> -->
                            <input type="text" name="lesson_no" class="form-control" autocomplete="off" required readonly
                                id="lesson_num">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lesson Name</label>
                            <input type="text" name="lesson_name" class="form-control" autocomplete="off" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Video Link</label>
                            <input type="url" name="lesson_url" class="form-control" autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Add Video</button>
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

            $(document).ready(function () {
                $("#course").change(function () {
                    $.ajax({
                        url: "../../data/set-next-lesson-num.php",
                        type: "POST",
                        data: {
                            course_id: $(this).children("option:selected").val()
                        },
                        success: function (data) {
                            $("#lesson_num").val(data);
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
}
?>