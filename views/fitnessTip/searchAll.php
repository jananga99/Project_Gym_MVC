<?php
if (isset($_POST['submit'])) {
    $_SESSION['data']['sort_arr'] = array();
    $_SESSION['data']['sort_arr']['for_which_gender'] = $_POST["gender"];
    header("Location:" . BASE_DIR . "FitnessTip/search");
    die();
}
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

        <h2>Get Tipness fits</h2>



        <form action="" method="POST">
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

</body>

</html>