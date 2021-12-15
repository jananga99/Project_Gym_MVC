<?php
//2018-12-05 12:39:16

if (isset($_POST['submit'])) {
    $_POST["dateTime"].=":00";
    $_POST["duration"].=":00";
    $_SESSION['data'] = $_POST;
    header("Location:".BASE_DIR."Session/add");
    die();
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
    include("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href="public/CSS/signup.css">

    <title>Create Session</title>
</head>

<body>

<a href=<?=BASE_DIR."Coach"?>>Dashboard</a>

<div class="simple-login-container">
    <h2>CREATE SESSION</h2>
    <div>
        <form action="" method="POST">

            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control"  name='sessionName' placeholder="Session Name">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control" name='dateTime' placeholder="Date & Time : 20YY-MM-DD HH:MM">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control"  name='duration' placeholder="Duration : HH:MM">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control" name='maxParticipants' placeholder="Number of expected participants">
                </div>
            </div>

            <div class="row">
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-block btn-login" name='submit' value='Create Session'>
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