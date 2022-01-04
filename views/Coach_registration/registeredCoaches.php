<?php


$arr = $_SESSION['data'];
if (sizeof($arr) == 0) $flag = 0;
else    $flag = 1;
$coach_arr = $_SESSION['data'];
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
    <title>Registered Coaches</title>
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



    <!-- <a href=<?= BASE_DIR . "Customer" ?>>Dashboard</a> -->

    <div class="container">


        <h2 class='m-5'>Registered Coaches</h2>

        <?php
        if ($flag) {
            echo "<div class='m-4'>
            <table  class='table table-hover' style='color:white'    >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>";
            foreach ($coach_arr as $row) {
                echo "<tr>
                    <td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>
                    <td>" . $row['Gender'] . "</td>
                    <td><form action=" . BASE_DIR . "Coach/view/" .$row['Email']. " method='POST'>
                            <button class='btn btn-outline-light btn-sm' >View</button>
                        </form></td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        }
        ?>
    </div>

    <?php
    require_once 'public/html/footer.html';
    ?>
</body>
<script src="public/js/search.js"></script>

</html>