<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/payment.css" ?>>
    <title>Customer view page</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class="container">
        <div class="report-submission">
            <form action="<?= BASE_DIR . "Report/submit_report" ?>" method="POST">
                <p> If you want to report this person please provide us reason and submit.</p>
                <input class="form-control mb-3" type="text" size="30" name="reason"><br>
                <input type="hidden" name="email" value="<?php echo $_SESSION['report_email'] ?>">
                <input class="btn btn-primary m-3" type="submit" value="Submit Report">
                <form>

        </div>

    </div>
    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

</html>