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
    require("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/search.css" ?>>
    <title>Registered Coaches</title>
</head>

<body>



    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#053657;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">VirtualGYM</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href=<?= BASE_DIR . "Customer" ?> class="nav-item nav-link ">Dashboard</a>
                    <a href=<?php echo BASE_DIR . "Customer/profile" ?> class="nav-item nav-link">Profile</a>
                    <a href="#" class="nav-item nav-link">Messages</a>


                    <a href=<?= BASE_DIR . "Auth/logout" ?> class="nav-item nav-link">Log Out</a>

                </div>
            </div>
    </nav>


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
                    <td><form action='' method='POST'>
                        <input type='text' name='select_email' value=" . $row['Email'] . " readonly style='display:none'>
                        <button class='btn btn-outline-light btn-sm' name='view_coach'>View</button>
                        </form></td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        }
        ?>
    </div>


</body>
<script src="public/js/search.js"></script>

</html>