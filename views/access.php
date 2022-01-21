<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/welcome.css" ?>>
    <title>HOME</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:	(100,138,109)">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">VirtualGYM</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>



    <div class="container">

        <img src="public/images/mainlogocpy.png" class="img1" alt="Welcome to the VirtualGYM">

        <!-- <h3 class="mb-5">Welcome to the VirtualGYM</h3> -->

        <!-- <div class="mb-3">

            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-light btn-lg" data-bs-toggle="collapse" data-bs-target="#demo1">Login</button>
            </div>

            <div id="demo1" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item"><a class="li" href="Auth/login">Customer</a></li>
                    <li class="list-group-item"><a class="li" href="Auth/login">Coach</a></li>
                    <li class="list-group-item"><a class="li" href="Auth/login">Admin</a></li>
                </ul>
            </div>
        </div> -->

        <div class="mb-3">
            <div class="d-grid gap-2">
                <a class="btn btn-outline-light btn-lg" href="Auth/login">Login</a>
            </div>

        </div>




        <div class="mb-3">
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-light btn-lg" data-bs-toggle="collapse" data-bs-target="#demo2">Signup</button>
            </div>

            <div id="demo2" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item"><a class="li" href="Customer/viewCreate">Customer</a></li>
                    <li class="list-group-item"><a class="li" href="Coach/viewCreate">Coach</a></li>
                    <li class="list-group-item"><a class="li" href="Admin/viewCreate">Admin</a></li>
                </ul>
            </div>
        </div>

    </div>


    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

</html>