<?php
session_start();
if (isset($_SESSION["email"]) && $_SESSION["role"] == "Teacher") {
    include("../../connection/conn.php");
    $status = $_GET['status'];
    $comment_id = $_GET['comment_id'];
    $std_name = $_GET['std_name'];
    $std_email = $_GET['std_email'];

    $sql = "SELECT message, date_added, message_type FROM comments_tbl WHERE status=$status AND comment_id=$comment_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $msg = $row['message'];
    $msg_type = $row['message_type'];
    $date = $row['date_added'];

    $fname = explode(" ", $std_name)[0];
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
        <title>Review Student Message | Techසර LK</title>
    </head>

    <body class="sb-nav-fixed">
        <?php include 'top-navbar.php'; ?>
        <?php include 'left-side-bar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="mt-4">Review
                    <?= $fname ?>'s Message
                </h1>

                <!-- Your further code goes here. keep coding in this div -->
                <div class="container mt-5">
                    <form class="shadow p-3  mt-5 form-w">
                        <h3>Fill all the Data</h3>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" name="std_name" class="form-control" value="<?= $std_name ?>"
                                autocomplete="off" required readonly id="lesson_num">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Student Email</label>
                            <input type="text" name="std_email" value="<?= $std_email ?>" class="form-control"
                                autocomplete="off" required readonly id="lesson_num">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="text" name="lesson_name" value="<?= $date ?>" class="form-control"
                                autocomplete="off" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message Type</label>
                            <input type="text" name="msg_type" value="<?= $msg_type ?>" class="form-control"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Current Message Status: </label>
                            <?php
                            if ($status == 0) {
                                ?>
                                <span class="badge rounded-pill text-bg-danger">Rejected</span>
                                <?php
                            } else if ($status == 1) {
                                ?>
                                    <span class="badge rounded-pill text-bg-success">Accepted</span>
                                <?php
                            } else {
                                ?>
                                    <span class="badge rounded-pill text-bg-warning">Pending</span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="msg" id="" cols="30" rows="5" class="form-control"><?= $msg ?></textarea>
                        </div>
                        <a class="btn btn-success"
                            href="../../data/change-comment-state.php?status=1&comment_id=<?= $comment_id ?>">Accept</a>
                        <a class="btn btn-warning"
                            href="../../data/change-comment-state.php?status=0&comment_id=<?= $comment_id ?>">Reject</a>
                        <a class="btn btn-danger"
                            href="../../data/delete-selected-comment.php?comment_id=<?= $comment_id ?>">Delete</a>
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