<?php
$plan_arr = $_SESSION['plan_arr'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/search.css" ?>>

    <title>View a Workout plan</title>
</head>

<body>
    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . "Customer/",
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class='container'>
        <table class='table table-hover' style='color:white'>
            <?php
            echo "
            <thead>
            <tr>
                <th>PLAN NAME</th>
                <th>VIEW</th>
            </tr>
            </thead>";

            foreach ($plan_arr as $plan) {
                echo "
            <tr>
                <td>" . $plan['Plan_Name'] . "</td>
                <td>
                    <form action='" . BASE_DIR . "WorkoutPlan/view/" . $plan['Plan_id'] . "' method='post'>
                        <button class='btn btn-outline-light btn-sm'>View</button>
                    </form>
                </td>
             </tr>            
            ";
            }

            ?>

        </table>

    </div>


    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

</html>