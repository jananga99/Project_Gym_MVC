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

    <?php
    $menu_arr = array(

        "Home" => BASE_DIR . ""
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>



    <div class="simple-login-container">
        <h2 class="m-5">Login Form</h2>
        <form action=<?php echo BASE_DIR . "Auth/checklogin"; ?> method="post">
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


    <div class="d-flex justify-content-center" >
        <p><?= $msg ?></p>
    </div>

    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

</html>