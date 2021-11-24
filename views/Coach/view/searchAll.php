<?php


$_SESSION['flags'] = isset($_SESSION['flags']) ? $_SESSION['flags'] : array();
if (isset($_POST["view_all"])) {
    $_SESSION['flags']['all'] = TRUE;
    unset($_POST);
    header("Location:".BASE_DIR."Customer/coach/search");
    die();
} elseif (isset($_POST["by"])) {
    $_SESSION['flags']['by'] = TRUE;
    if (isset($_POST["order_by"])  && $_POST["order_by"] != "none") {
        $_SESSION['flags']['orderField'] = "CONCAT(FirstName,LastName)";
        if ($_POST['order_radio_name'] == 'z_to_a')
            $_SESSION['flags']['$reverse'] = 1;
    }
    if (isset($_POST["sort_by_gender"])) {
        $_SESSION['flags']['sort_arr'] = array();
        $_SESSION['flags']['sort_arr']['gender'] = $_POST["sort_radio_gender"];
    }
    unset($_POST);
    header("Location:".BASE_DIR."Customer/coach/search");
    die();
} 
$coach_arr = isset($_SESSION['data']) ? $_SESSION['data'] : array();
$flag_all = isset($_SESSION['flags']['all']);
$flag_by = isset($_SESSION['flags']['by']);
unset($_SESSION['flags']);
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
    <link rel="stylesheet" href="../../../build/CSS/search.css">
    <title>Search Coach</title>
</head>

<body>

    <a href=<?=BASE_DIR."Customer"?>>Dashboard</a>

    <div class="container">

        <h2>Seach for a coach</h2>

        <div class="d-flex flex-column bd-highlight mb-3">
            <form action="" method="POST">
                <button name="view_all">View All</button>
            </form>

            <div class="d-flex justify-content-center flex-row bd-highlight mb-3">

                <div class="d-flex flex-column m-3 bd-highlight mb-3">
                    <p>Order By</p>
                    <form action="" method="post">

                        <!-- Order by options div -->
                        <div>
                            <input type="radio" onclick="fun1();fun3();" name="order_by" id="order_check_none" value="none">
                            <label>None</label><br>
                            <input type="radio" onclick="fun1();fun3();" name="order_by" id="order_check_name" value="name">
                            <label>Name</label><br>
                            <div id='order_radio_name' style="display:none;">
                                <input type="radio" name="order_radio_name" checked value="a_to_z">
                                <label>A to Z</label>
                                <input type="radio" name="order_radio_name" value="z_to_a">
                                <label>Z to A</label>
                            </div>
                        </div>
                </div>
                <!-- end of order by options -->

                <div class="d-flex flex-column  m-3 bd-highlight mb-3">
                    <p>Sort by</p>
                    <!-- Sort by options -->
                    <div>
                        <input type="checkbox" onclick="fun2();fun3();" name="sort_by_gender" id="sort_check_gender">
                        <label>Gender</label><br>
                        <div id='sort_radio_gender'>
                            <input type="radio" name="sort_radio_gender" checked value="Male">
                            <labe>Male</label>
                            <input type="radio" name="sort_radio_gender" value="Female">
                            <labe>Female</label>
                        </div>
                    </div>
                    <!-- end of sort by options -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="by" id="by" >Search</button>

            </form>
        </div>

        <?php
        if ($flag_all || $flag_by) {
            echo "<div>
        <table border='2'>
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
                <td><form action=".BASE_DIR."Customer/coach/select method='POST'>
                    <input type='text' name='select_email' value=" . $row['Email'] . " readonly style='display:none'>
                    <button name='select'>Select</button>
                    </form></td>
            </tr>";
            }
            echo "</tbody>
        </table>
    </div>";
        }
        ?>


</body>
<script src="public/js/search.js"></script>

</html>