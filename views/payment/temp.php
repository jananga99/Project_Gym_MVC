<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/search.css" ?>>

    <title>Document</title>
</head>

<body>
    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['user']['type'],
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class="container">
        <h1>TEMP PAGE UNTIL</h1>

        <!--<form action=<?= BASE_DIR . "Payment/session/1" ?> method="post">-->
        <?php

        if ($_SESSION['data']['flag'] === "create_session")
            echo "<form action= " . BASE_DIR . "Payment/pay/createSession" . "  method='post'>";
        elseif ($_SESSION['data']['flag'] === "register_session")
            echo "<form action=" . BASE_DIR . "Payment/pay/registerSession" . "  method='post'>";
        elseif ($_SESSION['data']['flag'] === "register_coach")
            echo "<form action=" . BASE_DIR . "Payment/pay/coachRegister" . "  method='post'>";


        ?>
        <label for="price">Price ($)</label>

        <input type="text" class="form-control" name='price' value=<?php echo $_SESSION['data']["price"] ?> readonly>
        <div class="m-3">
            <input type="submit" class="btn btn-primary" value='Enter Payment Details'>

            </form>
        </div>
    </div>
    <?php
    require 'public/html/footer.html';
    ?>

</body>

</html>