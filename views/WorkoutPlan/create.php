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
    include("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href="public/CSS/signup.css">

    <title>Add a fitness tip</title>
</head>

<body>

<div class="simple-login-container">

<a href=<?=BASE_DIR."Coach"?>>Dashboard</a>

<h2>Add a fitness tip</h2>
    <div>
        <form action=<?=BASE_DIR."WorkoutPlan/create/1"?> method="POST">

            <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control"  name='plan_name' placeholder="Plan Name">
                    </div>
            </div>

            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control"  name='plan' placeholder="Enter Workout Plan">
                </div>
            </div>
            <p>Customers</p>
            <?php
            echo "<div class='m-4'>
            <table  class='table table-hover' style='color:red'    >
                <thead>
                    <tr>
                        <th>Customer Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
            foreach ($customer_arr as $row) {
                echo "<tr>
                    <td>" . $row['Customer'] . " </td>
                    <td>
                        <input type='text' name='customer_email' value=" . $row['Customer'] . " readonly style='display:none'>
                        <button value='Select'>Select</button>
                    </td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
            
            
            
            ?>

            <div class="row">
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-block btn-login" name='submit' value='Create'>
                </div>
            </div>
        </form>
    </div>
</div>   

    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>
</body>

</html>