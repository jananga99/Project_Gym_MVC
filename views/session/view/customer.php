<?php

$arr = $_SESSION['data'];
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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/login.css" ?>>

    <title>Session View</title>
</head>

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


<body>

    <?php
    // require_once("../../../build/HTML/navbar.php");
    ?>


    <div class="simple-login-container">
        <h2>Session Details</h2>
        <div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Session Id</label>
                    <input type="text" class="form-control" name='session_id' value=<?php echo $arr["Session_id"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Session Name</label>
                    <input type="text" class="form-control" name='session_name' value=<?php echo $arr["Session_Name"] ?> readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Coach</label>
                    <input type="text" class="form-control" name='coach_email' value=<?php echo $arr["Coach_Email"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name='date' value=<?php echo $arr["Date"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" name='startTime' value=<?php echo $arr["Start_Time"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>End Time</label>
                    <input type="text" class="form-control" name='endTime' value=<?php echo $arr["End_Time"] ?> readonly>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Number of participants</label>
                    <input type="text" class="form-control" name='num_participants' value=<?php echo $arr["Num_Participants"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name='price' value=<?php echo $arr["Price"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Details</label>
                    <input type="text" class="form-control" name='details' value=<?php echo $arr["Details"] ?> readonly>
                </div>
            </div>


            <?php
            if ($arr['isRegistered'])
                echo "<form action=" . BASE_DIR . "Session/unregister/" . $arr["Session_id"] . " method='POST'>";
            else
                echo "<form action=" . BASE_DIR . "Session/register/" . $arr['Session_id'] . " method='POST'>";
            ?>
            <div class="row">
                <div class="col-md-12 form-group">
                    <?php
                    echo "<input type='text' class='form-control' name='price' readonly style='display:none' value=" . $arr['Price'] . ">";
                    if ($arr['isRegistered']) {
                        echo "<input type='submit' class='btn btn-block btn-login' value='Unregister From Session' >";
                        echo "<input type='text' value=" . $arr['isRegistered'] . " name='Session_Registration_id' readonly style='display:none'>";
                    } else
                        echo "<input type='submit' class='btn btn-block btn-login' value='Register For Session' >";
                    ?>
                </div>
            </div>
            </form>

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