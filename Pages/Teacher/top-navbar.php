<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="../../index.php"><img src="../../src/imgs/logo.png" width="45" title="Techසර LK
        School"> Techසර LK
        School</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Message Indicator -->
    <button type="button" onclick="route();"
        class="btn btn-primary position-relative d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        Inbox
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php
            include("../../connection/conn.php");
            $sql = "SELECT COUNT(*) num FROM comments_tbl WHERE status=2";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $count = $row['num'];
                echo $count;
            }
            $conn->close();
            ?>
            <span class="visually-hidden">Unread messages</span>
        </span>
    </button>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <span class="dropdown-item" title="User">
                    <?php
                    include("../../connection/conn.php");
                    $email = $_SESSION['email'];
                    $role = $_SESSION["role"];
                    // echo $email;
                    if ($role == "Teacher") {
                        $sql = "SELECT title, first_name, last_name FROM teacher_tbl WHERE email='$email'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $name = $row["title"] . " " . $row['first_name'] . " " . $row['last_name'];
                            echo $name;
                        }
                    } else {
                        $sql = "SELECT first_name, last_name FROM student_tbl WHERE email='$email'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $name = $row['first_name'] . " " . $row['last_name'];
                            echo $name;
                        }
                    }

                    ?>
                </span>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <!-- <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="settings.php">Settings</a></li> -->
                <li><a class="dropdown-item" href="../../includes/logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>

</nav>

<script>
    function route() {
        window.location.href = "./review-messages.php";
    }
</script>