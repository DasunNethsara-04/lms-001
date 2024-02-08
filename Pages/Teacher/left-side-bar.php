<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="./dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                        PlayLists
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="./view-playlists.php">View</a>
                            <a class="nav-link" href="./add-playlist.php">Add New Playlist</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-video"></i></div>
                        Videos
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="view-videos.php">View</a>
                            <a class="nav-link" href="add-videos.php">Add New Video</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts8"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        Students
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts8" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="view-students.php">Student Details</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="./teacher-profile.php">
                        <div class="sb-nav-link-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                        Profile
                    </a>
                    <a class="nav-link getPopup" href="./settings.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                        Settings
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <b title='Your Role'>
                    <?= $_SESSION['role'] ?>
                </b>
            </div>
        </nav>
    </div>