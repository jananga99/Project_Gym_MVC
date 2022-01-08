<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once("public/HTML/boostraplinks.html");
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


            <div class="d-flex justify-content-center flex-row bd-highlight mb-3">
                <!-- <label for="message_type">TO</label> -->
                <div class="d-flex flex-column m-1 bd-highlight ">

                    <select class="form-select form-select-sm" name="message_type">
                        <?php
                        foreach ($_SESSION['data'] as $value => $text)
                            echo "<option value=" . $value . ">" . $text . "</option>";
                        ?>
                    </select>
                </div>

            </div>


            <div class="d-flex justify-content-center flex-row bd-highlight mb-3">

                <input class="form-control" placeholder="type your msg here" type="text" name="message">
                <input class='btn btn-outline-light m-2 ' type="submit" value="SEND">
            </div>





        </form>
    </div>
    <?php
    require_once 'public/html/footer.html';
    ?>


</body>

</html>