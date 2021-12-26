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
        "Profile" => BASE_DIR . "Coach/view",
        "Notifications" => BASE_DIR . "Notification",
        "Reports" => "#",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

    <div class="container">

        <h1 class="mb-4">Welcome</h1>

        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Session/create" ?>>Create a session</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Session/view/all" ?>>My Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Session/search" ?>>All Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "FitnessTip/create" ?>>Add Fitness Tips</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Message/send" ?>>Send Messages</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "WorkoutPlan/create" ?>>CreatePlan</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "WorkoutPlan/view/1" ?>>View Work out Plans</a>

    </div>


    <?php
    require 'public/html/footer.html';
    ?>


</body>


</html>