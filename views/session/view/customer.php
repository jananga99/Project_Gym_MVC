<?php

$sessionId = $_SESSION['data']['select_session'];
$arr = $_SESSION['data'];
$styleReg = "display:none";
$styleAddSession = "";

$price = 1000;

if ($_SESSION['data']['isRegistered']) {
    $styleAddSession = "display:none";
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
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/login.css" ?>>


    <title>Session View</title>
</head>

<nav class="navbar navbar-expand-md navbar-dark" style="background-color:#053657;">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">VirtualGYM</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href=<?= BASE_DIR . $_SESSION['user']['type'] ?> class="nav-item nav-link ">Dashboard</a>
                <a href=<?= BASE_DIR . "Session/search" ?> class="nav-item nav-link">Back</a>
                <a href=<?= BASE_DIR . "Session/registered" ?> class="nav-item nav-link">Registered Sessions</a>


                <a href=<?= BASE_DIR . "Auth/logout" ?> class="nav-item nav-link">Log Out</a>

            </div>
        </div>
</nav>


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

            <div class="row" style=<?php echo $styleAddSession; ?>>
                <div class="col-md-12 form-group">
                    <form action=<?= BASE_DIR . "Payment/session" ?> method="POST">
                        <input type="text" class="form-control" name='select_session' value=<?php echo $arr["Session_id"] ?> readonly style="display:none">
                        <input type="text" class="form-control" name='price' value=<?php echo $arr["Price"] ?> readonly style="display:none">
                        <input type="submit" class="btn btn-block btn-login m-3" value='Register' name='add_session'>
                    </form>
                </div>
            </div>
            <div class="row" style=<?php echo $styleReg; ?>>
                <form action=<?= BASE_DIR . "Session/unregister" ?> method="POST">
                    <input type="text" name='unregister_session' value=<?php echo $arr["Session_id"] ?> style="display:none" readonly>
                    <button class="btn btn-block btn-login m-3" name="unregister" value='Unregister'>Unregister</button>
                </form>

            </div>

        </div>
    </div>




    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>
</body>

</html>