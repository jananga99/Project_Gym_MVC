<?php

$arr = $_SESSION['data'];
$styleReg = "display:none";
$styleAddCoach = "";
if ($arr['isRegistered']) {
    $styleAddCoach = "display:none";
    $styleReg = "";
}
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
    require("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/signup.css" ?>>

    <title>coach details</title>
</head>

<body>
    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . "Customer",
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Back" => BASE_DIR . "Customer/coach/search",

        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>
    <!-- 
    <a href=<?= BASE_DIR . 'Customer/coach/search' ?>>Back to search</a><br>
    <a href=<?= BASE_DIR . 'Customer/coach/registered' ?>>My Coaches</a> -->
    <div class="simple-login-container">
        <h2>Coach Details</h2>
        <div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name='fname' value=<?php echo $arr["FirstName"] ?> readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name='lname' value=<?php echo $arr["LastName"] ?> readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Age (years)</label>
                    <input type="text" class="form-control" name='age' value=<?php echo $arr["Age"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>City</label>
                    <input type="text" class="form-control" name='city' value=<?php echo $arr["City"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Gender</label>
                    <input type="text" class="form-control" name='gender' value=<?php echo $arr["Gender"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Tel No</label>
                    <input type="text" class="form-control" name='tel' value=<?php echo $arr["Telephone"] ?> readonly>
                </div>
            </div>
            <form action=<?= BASE_DIR . "Payment/coachRegister" ?> method="POST">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name='select_email' value=<?php echo $arr["Email"] ?> readonly>
                    </div>
                </div>
                <div class="row" style=<?php echo $styleAddCoach; ?>>
                    <div class="col-md-12 form-group">

                        <input type="submit" class="btn btn-block btn-login" value='Add Coach' name='add_coach'>

                    </div>
                </div>
            </form>
            <div class="row m-3" style=<?php echo $styleReg; ?>>
                <div class="d-grid gap-2">
                    <button class="btn btn-block btn-login" value='Already registered.'>Already Registered</button>
                </div>
            </div>

        </div>
    </div>




    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>

    <?php
    require 'public/html/footer.html';
    ?>

</body>

</html>