<?php
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/login.css" ?>>
    <title>Log in</title>
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
                    <a href=<?= BASE_DIR ?> class="nav-item nav-link">Home</a>
                </div>
            </div>
        </div>
    </nav>



    <div class="simple-login-container">
        <h2 class="m-5">Login Form</h2>
        <form action=<?php echo BASE_DIR . "Auth/checklogin" ; ?> method="post">
            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control" placeholder="Email" name='email'>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 form-group">
                    <input type="password" placeholder="Enter your Password" class="form-control" name='password'>
                </div>
            </div>
            <div class="row">
                <div class="d-grid gap-2 form-group">
                    <input type="submit" class="btn btn-block btn-login" name='submit'>
                </div>
            </div>
        </form>
    </div>


    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>
</body>

</html>