<?php
//2018-12-05 12:39:16

if (isset($_POST['submit'])) {
    print_r($_POST);
    
    $_POST["startTime"].=":00";
    $_POST["endTime"].=":00";
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
                <label for="sessionName">Session Name</label>
                <div class="mb-3 form-group">
                    <input type="text" class="form-control"  name='sessionName' placeholder="Session Name" required>
                </div>
            </div>

            <div class="row">
                <label for="date">Date (MM/DD/YYYY)</label> 
                <div class="mb-3 form-group">
                    <input type="date" class="form-control" name='date' required >
                </div>
            </div>

            <div class="row">
                <label for="startTime">Start Time (00:00 AM)</label>
                <div class="mb-3 form-group">
                    <input type="time" class="form-control" name='startTime' required >
                </div>
            </div>


            <div class="row">
                <label for="EndTime">End Time (00:00 AM)</label>
                <div class="mb-3 form-group">
                    <input type="time" class="form-control"  name='endTime' required>
                </div>
            </div>

            <div class="row">
                <label for="maxParticipants">Expected number of participants</label>
                <div class="mb-3 form-group">
                    <input type="number" class="form-control" name='maxParticipants' placeholder="Number of expected participants" required>
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