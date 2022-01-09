<!-- View by himself -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/dash.css" ?>>
    <title>Dashboard</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Profile" => BASE_DIR . "Admin/view/{$_SESSION['logged_user']['email']}",
        "Reports" => BASE_DIR . "Admin/view_reports",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>




    <div class="container">

        <h1 class="mb-4">Welcome</h1>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Message/viewSend" ?>>Send Messages</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Payment/viewSetPrice" ?>>Set Prices</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Session/viewAll" ?>>All Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Customer/viewAll" ?>>All Customers</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Coach/viewAll" ?>>All Coaches</a>

    </div>
</body>

</html>