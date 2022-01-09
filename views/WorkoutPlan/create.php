<?php
$customer_arr = $_SESSION['customer_arr'];
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);
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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/workout.css" ?>>

    <title>Add a Workout plan</title>
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


    <div class="container">

        <h2>Add a fitness tip</h2>
        <div>
            <form action=<?= BASE_DIR . "WorkoutPlan/create" ?> method="POST">

                <div class="row m-3">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='plan_name' placeholder="Plan Name">
                    </div>
                </div>

                <div class="row m-3">
                    <div class="d-grid gap-3 form-group">
                        <input class="btn btn-outline-light" type="button" onclick="createTable()" value="Create the schedule">
                    </div>
                </div>

                <div class="row m-3">
                    <div class="mb-3  form-group">
                        <table id="myTable" class='table table-bordered table-hover' style='color:white'>
                        </table>
                    </div>
                </div>
                <p>Customers</p>
                <?php
                echo "<div class='m-4'>
            <table class='table table-bordered table-hover' style='color:white'   >
                <thead>
                    <tr>
                        <th>Customer Email</th>
                        <th>select</th>
                    </tr>
                </thead>
                <tbody>";
                $c = 0;
                foreach ($customer_arr as $row) {
                    echo "<tr>
                    <td>" . $row['Customer'] . " </td>
                    <td>
                        <input type='checkbox' id='check1' name='customer_email" . $c . "' class='pl' value=" . $row['Customer'] . "> 
                    </td>
                </tr>";
                    $c += 1;
                }
                echo "</tbody>
            </table>
        </div>";



                ?>
                <!--   <input type="button" onclick="getCheckboxValue()" value="test">   -->

                <div class="row">

                    <div class="m-3">
                        <input type="submit" class="btn btn-primary btn-lg" value='Create Plan'>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>


    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

<script src=<?= BASE_DIR . "public/js/workout.js" ?>></script>

</html>