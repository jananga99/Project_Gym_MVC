<!-- View by himself -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/dash.css" ?>>
    <title>Dashboard</title>
</head>

<body>


    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#053657;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">VirtualGYM</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link ">Dashboard</a>
                    <a href=<?php echo BASE_DIR . "Admin/view" ?> class="nav-item nav-link">Profile</a>
                    <a href=<?php echo BASE_DIR . "Notification" ?> class="nav-item nav-link">Notifications</a>
                    <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a>

                    <a href=<?= BASE_DIR . "Auth/logout" ?> class="nav-item nav-link">Log Out</a>

                </div>
            </div>
    </nav>




    <div class="container">

        <h1 class="mb-4">Welcome</h1>

        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Admin/view" ?>>edit profile</a>

    </div>
</body>

</html>