<nav class="navbar navbar-expand-md navbar-dark" style="background-color:	(100,138,109)">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">VirtualGYM</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="#" class="nav-item nav-link ">Contact</a>
                <a href="#" class="nav-item nav-link">AboutUs</a>

                <a href="#" class="nav-item nav-link">Home</a>
            </div>
        </div>
    </div>
</nav>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/welcome.css" ?>>
    <title>HOME</title>
</head>

<body>

    <div class="container">

        <img src="public/images/mainlogocpy.png" class="img1" alt="Welcome to the VirtualGYM">

        <!-- <h3 class="mb-5">Welcome to the VirtualGYM</h3> -->

        <div class="mb-3">

            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-light btn-lg" data-bs-toggle="collapse" data-bs-target="#demo1">Login</button>
            </div>

            <div id="demo1" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item"><a class="li" href="Auth/login/Customer">Customer</a></li>
                    <li class="list-group-item"><a class="li" href="Auth/login/Coach">Coach</a></li>
                    <li class="list-group-item"><a class="li" href="Auth/login/Admin">Admin</a></li>
                </ul>
            </div>
        </div>

        <div class="mb-3">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-light btn-lg" data-bs-toggle="collapse" data-bs-target="#demo2">Signup</button>
            </div>

            <div id="demo2" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item"><a class="li" href="Auth/signup/Customer">Customer</a></li>
                    <li class="list-group-item"><a class="li" href="Auth/signup/Coach">Coach</a></li>
                    <li class="list-group-item"><a class="li" href="Auth/signup/Admin">Admin</a></li>
                </ul>
            </div>
        </div>

    </div>



</body>

</html>