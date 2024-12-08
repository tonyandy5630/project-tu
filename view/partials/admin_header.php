<header class="shadow-sm">
    <nav class="navbar navbar-expand-lg ">
        <div class="container-sm mx-auto">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-light"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">
                    <a class="navbar-brand" href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/f/f0/HCMCUT.svg" width="95px" height="76px" alt="Logo_coolmate">
                    </a>
                    <p class="navbar-brand my-auto fw-bold">Admin Page</p>
                </a>
                <div class="d-flex w-100 justify-content-between">
                    <ul class="d-flex navbar-nav justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/admin/members">Members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/admin">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/admins">Admins</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav row-gap-3 text-light">
                        <?php
                        $isLoggedIn = isset($_SESSION['admin_email']);
                        if ($isLoggedIn) {
                            $email = $_SESSION['admin_email'];
                        ?>
                            <li class="nav-item me-1 my-auto">Welcome back <b><?= $email ?></b></li>
                            <li class="nav-item"><a href="/admin/logout" class="btn btn-outline-light">Log out</a></li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/login">Login</a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>