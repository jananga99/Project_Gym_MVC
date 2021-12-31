<?php
$creating_price = 100;
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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/sessions.css" ?>>

    <title>Create Session</title>
</head>

<body>

    <!-- <a href=<?= BASE_DIR . "Coach" ?>>Dashboard</a> -->


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
        <h2>CREATE SESSION</h2>
        <div>
            <form action=<?= BASE_DIR . "Session/create"; ?> method="POST">
                <div class="row">
                    <label for="sessionName">Session Name</label>
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='sessionName' placeholder="Session Name" required>
                    </div>
                </div>

                <div class="row">
                    <label for="date">Date (MM/DD/YYYY)</label>
                    <div class="mb-3 form-group">
                        <input type="date" class="form-control" name='date' required>
                    </div>
                </div>

                <div class="row">
                    <label for="startTime">Start Time (00:00 AM)</label>
                    <div class="mb-3 form-group">
                        <input type="time" class="form-control" name='startTime' required>
                    </div>
                </div>


                <div class="row">
                    <label for="EndTime">End Time (00:00 AM)</label>
                    <div class="mb-3 form-group">
                        <input type="time" class="form-control" name='endTime' required>
                    </div>
                </div>

                <div class="row">
                    <label for="maxParticipants">Expected number of participants</label>
                    <div class="mb-3 form-group">
                        <input type="number" class="form-control" name='maxParticipants' placeholder="Number of expected participants" required>
                    </div>
                </div>

                <div class="row">
                    <label for="price">Price($)</label>
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='price' placeholder="00.00" required>
                    </div>
                </div>

                <div class="row">
                    <label for="details">Details</label>
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='details' placeholder="Add a brief ">
                    </div>
                </div>

                <div class="row">
                    <div class="d-grid gap-2">
                        <input type="text" class="btn btn-block btn-login" name='createPrice' value=<?= $creating_price; ?> style="display:none">
                        <input type="submit" class="btn btn-primary" name='submit' value='Create Session'>
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