<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/payment.css" ?>>
    <title>Payment Success</title>
</head>

<body>

    <body>

        <?php
        $menu_arr = array(
            "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
            "Log Out" => BASE_DIR . "Auth/logout"
        );
        $navbar =  new Navbar($menu_arr);
        echo $navbar->get();
        ?>



        <div class="container">

            <div class="m-6">
                <h1>PAYMENT SUCCESS</h1>
            </div>

            <a class="btn btn-primary" href=<?= BASE_DIR."Payment/finish"; ?>>Finish Payment</a>

        </div>

        <?php
        require 'public/html/footer.html';
        ?>


    </body>

</html>