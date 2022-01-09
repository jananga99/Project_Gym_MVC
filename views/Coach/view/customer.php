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
    require_once("public/HTML/boostraplinks.html");
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
        "SearchCoach" => BASE_DIR . "Coach/viewAll",

        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

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
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name='coach_email' value=<?php echo $arr["Email"] ?> readonly>
                </div>
            </div>
            <?php
            if ($arr['isRegistered'])
                echo "<form action=" . BASE_DIR . "Coach_Registration/unregister/" . $arr['isRegistered'] . " method='POST'>";
            else
                echo "<form action=" . BASE_DIR . "Coach_Registration/checkRegister/" . $arr["Email"] . " method='POST'>";
            ?>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Registration Price</label>
                    <input type="text" class="form-control" name='price' value=<?php echo $arr['registration_price'] ?> readonly>
                </div>
            </div>

            <div class="row m-3">
                <div class="d-grid gap-2">
                    <?php
                    if ($arr['isRegistered']) {
                        echo "<input type='submit' class='btn btn-block btn-login' value='Unregister For Coach' >";
                    } else
                        echo "<input type='submit' class='btn btn-block btn-login' value='Register For Coach' >";
                    ?>
                </div>
                </form>
            </div>


            <div class="row m-3">
                <div class="d-grid gap-2">
                    <a href=<?= BASE_DIR . "Report/view_create/" . $arr["Email"] ?>>
                        <button type="button" class='btn btn-block btn-login'>Report Coach</button>
                        <!-- we must sent coaches email hidennly to report page -->
                    </a>
                </div>
            </div>



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