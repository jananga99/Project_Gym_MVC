<!DOCTYPE html>
<html lang="en">
<?php
$plan_data = $_SESSION['data'];
$plan = $plan_data['Plan'];
$step_count = count($plan) / 2;
?>

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
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
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
                <th>TIME</th>
                <th>TODO</th>
            </tr>
            </thead>
            
            <tbody>";

            for ($i = 0; $i < $step_count; $i++) {
                echo "<tr>
                <td>
                    <p>{$plan['planTime' .$i]}</p>
                </td>
                <td>
                    <p>{$plan['planTodo' .$i]}</p>
                </td>
                </tr>";
            }


            echo "</tbody>";

            ?>

        </table>

    </div>
</body>

</html>