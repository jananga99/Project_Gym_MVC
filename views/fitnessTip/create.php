<?php
if (isset($_POST['submit'])) {
    $_SESSION['data'] = $_POST;
    header("Location:".BASE_DIR."FitnessTip/add");
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

    <title>Add a fitness tip</title>
</head>

<body>

<div class="simple-login-container">

<a href=<?=BASE_DIR."Coach"?>>Dashboard</a>

<h2>Add a fitness tip</h2>
    <div>
        <form action="" method="POST">

            <div class="row">
                <div class="mb-3 form-group">
                    <input type="text" class="form-control"  name='tip' placeholder="Enter tip">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 form-group">
                    <label for="Gender">For which Gender</label>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Both">Not specific</option>
                    </select><br>
                </div>
            </div>

            <div class="row">
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-block btn-login" name='submit' value='add_tip'>
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