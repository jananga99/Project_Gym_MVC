<!-- View by himself -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/dash.css" ?>>
    <title>Dashboard</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Profile" => BASE_DIR . "Admin/view/{$_SESSION['logged_user']['email']}",
        "Reports" => "#",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>




    <div class="container">

        <h1 class="mb-4">Welcome</h1>

        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Admin/view/{$_SESSION['logged_user']['email']}" ?>>edit profile</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Message/viewSend" ?>>Send Messages</a>

    </div>
</body>

</html>