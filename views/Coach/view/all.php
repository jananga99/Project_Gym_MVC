<?php
$coach_arr = isset($_SESSION['data']) ? $_SESSION['data'] : array();

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
    <title>Search Coach</title>
</head>
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
<body>

    <div class="container">

        <h2>Seach for a coach</h2>

        <div class="d-flex flex-column bd-highlight mb-3">
            <form action=<?=BASE_DIR . "Coach/viewAll"?> method="POST">
                <button class="btn btn-outline-light btn-md" name="view_all">View All</button>
            </form>

            <form action=<?=BASE_DIR . "Coach/viewAll"?> method="post">
                <div class="d-flex justify-content-center flex-row bd-highlight mb-3">

                    <div class="d-flex flex-column m-3 bd-highlight mb-3">
                        <p>Order By</p>


                            <!-- Order by options div -->
                            <div>
                                <input type="radio" onclick="fun1();fun3();"  name="order_by" id="order_check_none" value="none">
                                <label>None</label><br>
                                <input type="radio" onclick="fun1();fun3();" name="order_by" id="order_check_name" value="name">
                                <label>Name</label><br>
                                <div id='order_radio_name' style="display:none;" >
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
                            <div id='sort_radio_gender' style="display:none;">
                                <input type="radio" name="sort_radio_gender" checked value="Male">
                                <labe>Male</label>
                                    <input type="radio" name="sort_radio_gender" value="Female">
                                    <labe>Female</label>
                            </div>
                        </div>
                        <!-- end of sort by options -->
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="by" id="by">Search</button>

            </form>
        </div>

        <?php
        if (isset($coach_arr)) {
            echo "<div>
        <table  class='table table-hover' style='color:white'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Select</th>

                </tr>
            </thead>
            <tbody>";
            foreach ($coach_arr as $row) {
                echo "<tr>
                <td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>
                <td>" . $row['Gender'] . "</td>
                <td><form action=" . BASE_DIR . "Coach/view method='POST'>
                    <input type='text' name='select_coach_email' value=" . $row['Email'] . " readonly style='display:none'>
                    <button class='btn btn-outline-light btn-sm' name='select'>Select</button>
                    </form></td>
            </tr>";
            }
            echo "</tbody>
        </table>
    </div>";
        }else{
            echo "<p>There are no coaches available yet.</p>";
        }
        ?>

    </div>

    <?php
    require 'public/html/footer.html';
    ?>


</body>
<script src=<?=BASE_DIR."public/js/search.js"?>></script>

</html>