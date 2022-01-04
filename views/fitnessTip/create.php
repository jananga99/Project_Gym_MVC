<?php
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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/search.css" ?>>

    <title>Add fitness tips</title>
</head>

<body>
    <!-- <a href=<?= BASE_DIR . "Coach" ?>>Dashboard</a> -->

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . "Coach/",
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

    <div class="container">



        <h2 class="m-5">Add a fitness tip</h2>
        <div>
            <form action=<?=BASE_DIR."FitnessTip/create1"?> method="POST">

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='tip' placeholder="Enter tip">
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
                    <div class="m-3">
                        <input type="submit" class="btn btn-primary" name='submit' value='add fitness tip'>
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

</html>