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
            "Dashboard"=>"#",
            "Profile"=>BASE_DIR . "Customer/profile",
            "Notifications"=>BASE_DIR . "Notification",
            "Reports"=>"#",
            "Messages"=>BASE_DIR . "Message",
            "Log Out"=>BASE_DIR . "Auth/logout"
        );
        $navbar =  new Navbar($menu_arr);
        echo $navbar->get();
    ?>

    <div class="container">


        <h1 class="mb-4">Welcome</h1>

        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Customer/coach/search" ?>>add coach</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Customer/profile/edit" ?>>edit profile</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Customer/coach/registered" ?>>Registered Coaches</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Session/search" ?>>Find Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "Session/registered" ?>>My Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=<?= BASE_DIR . "FitnessTip/search" ?>>Get Finess Tips</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=#>Get Workout plan</a>



    </div>


</html>