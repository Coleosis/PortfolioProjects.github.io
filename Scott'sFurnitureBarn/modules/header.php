<header>
    <?php
    include("./modules/notification.php");
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    include("./modules/cartCount.php");
    ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark ">
        <div class="container">
            <div id="headerImg">
                <a class="navbar-brand" href="index.php"><img src="./favicon/apple-touch-icon.png" alt="" class="img-fluid rounded" width="40px" style="
                position: absolute;
                top: 10px;
                "></a>
            </div>
            <div class="d-flex flex-row-reverse">
                <div class="">
                    <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="d-flex me-2">
                    <div class="d-block mt-1 me-2">
                        <?php
                        // Logic to ensure $_SESSION['LoggedIn'] is not missing.
                        if (!isset($_SESSION["LoggedIn"])) {
                            $_SESSION['LoggedIn'] = false;
                        }
                        if ($_SESSION['LoggedIn'] == true) {
                            include './login/view/logout.php';
                        } else {
                            include './login/view/signin.php';
                        } ?>
                    </div>
                    <?php
                    if ($_SESSION['LoggedIn'] == true) {
                    ?>
                        <a class="text-light pe-1 rounded me-2" href="account.php" data-bs-toggle="tooltip" title="Account Details">
                            <i class="bi bi-person-circle h1"></i>
                        </a>
                    <?php
                    }
                    ?>
                    <div class="container-fluid">
                        <a class="nav-link text-light pe-1 position-relative rounded" data-bs-toggle="tooltip" title="Reserved Item's" href="reserve.php"> <!-- To reserve Page -->
                            <i class="bi bi-cart3 h1 me-1"></i>
                            <div id="cartAmount" class=" badge text-light rounded translate-middle"><?php echo $_SESSION['cartCount'] ?></div>
                        </a>
                    </div>
                </div>
                <div class="">
                    <div class="collapse navbar-collapse justify-content-center text-center" id="navbarResponsive">
                        <ul class="navbar-nav">
                            <li class="nav-item mt-md-0 mt-5"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                            <li class="nav-item"><a class="nav-link" href="donationform_view.php">Donate</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                            <?php if (isset($_SESSION['isAdmin'])) {
                                echo '<li class="nav-item"><a class="nav-link" href="/SWDV280/admin">Admin</a></li>';
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- The Modal -->
    <div class="modal" id="adminLoginModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3>Admin Log In</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container my-3">
                        <form action="admin/adminLogin/adminLogin.php" method="post">
                            <div class="form-floating mb-3 mt-3">
                                <input type="text" class="form-control border border-4" id="adminUsername" placeholder2="Enter Username" name="adminUsername">
                                <label for="adminUsername">Username</label>
                            </div>

                            <div class="form-floating mt-3 mb-3">
                                <input type="password" class="form-control border border-4" id="adminPassword" placeholder="Enter password" name="adminPassword">
                                <label for="adminPassword">Password</label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-dark">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</header>