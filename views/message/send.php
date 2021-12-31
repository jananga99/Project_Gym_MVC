<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/notification.css" ?>>
    <title>Message Send</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Notifications" => BASE_DIR . "Notification",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

    <div class="container">

        <h2>Message Send</h2>


        <form class="m-3" action=<?= BASE_DIR . "Message/send" ?> method="post">

            <input type="text" name="message">
            <input type="submit" value="SEND">



        </form>
    </div>
    <?php
    require 'public/html/footer.html';
    ?>


</body>

</html>