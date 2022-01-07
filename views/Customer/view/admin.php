<?php
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);
$arr = $_SESSION['data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once 'public/HTML/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/signup.css" ?>>

    <title>Customer update profile</title>
</head>




<body>
    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . "Coach",
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class="simple-login-container">
        <h2>Customer Details</h2>
        <div>
           
            <div class="row">
                <div class="mb-3 form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name='fname' readonly value=<?php echo $arr["FirstName"] ?>>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name='lname' readonly value=<?php echo $arr["LastName"] ?>>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 form-group">
                    <label>Age (years)</label>
                    <input type="text" class="form-control" name='age' readonly value=<?php echo $arr["Age"] ?>>
                </div>
            </div>
            <div class="row">
                <div class="mb-3  form-group">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" name='gender' readonly value=<?php echo $arr["Gender"] ?>>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 form-group">
                    <label>Tel No</label>
                    <input type="text" class="form-control" readonly name='tel' value=<?php echo $arr["Telephone"] ?>>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name='email' value=<?php echo $arr["Email"] ?> readonly>
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