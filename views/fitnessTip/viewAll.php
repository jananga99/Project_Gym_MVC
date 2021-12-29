<?php

$tip_arr =  isset($_SESSION['data']) ? $_SESSION['data'] : array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/search.css" ?>>
    <title>Get Fitness Tips</title>
</head>

<body>


    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . "Customer",
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

    <div class="container">

        <h2>Get Tipness fits</h2>

        <form action=<?=BASE_DIR."FitnessTip/viewAll"?> method="POST">
            <div class='d-flex flex-column m-3 bd-highlight mb-3'>
                <div class="m-3">
                    <label for="Gender">Gender</label>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Both">Both</option>
                    </select>
                </div>

                <input class="btn btn-primary" type="submit" value="Get Tips" name="submit">
            </div>


        </form>


        <?php
        if (sizeof($tip_arr)) {
            echo "<div>
            <table  class='table table-hover' style='color:white'>
                <thead>
                    <tr>
                        <th>TIPS</th>
                    </tr>
                </thead>
                <tbody>";
            foreach ($tip_arr as $row) {
                echo "<tr>
                    <td>" . $row['Tip'] . "</td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        }


        ?>

    </div>

    <?php
    require 'public/html/footer.html';
    ?>



</body>

</html>