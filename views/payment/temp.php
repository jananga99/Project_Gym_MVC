<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/search.css" ?>>

    <title>Payment Details</title>
</head>

<body>
    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class="container">
        <h1>
            <?php
            if ($_SESSION['payment_data']['Payment_Type'] == PAYMENT_SESSION_REGISTER)   echo "Session Registering Payment";
            elseif ($_SESSION['payment_data']['Payment_Type'] == PAYMENT_COACH_REGISTER)   echo "Coach Registering Payment";
            elseif ($_SESSION['payment_data']['Payment_Type'] == PAYMENT_SESSION_CREATE)   echo "Session Creating Payment";
            ?>

        </h1>
        <?php
        echo "<form action= " . BASE_DIR . "Payment/viewPay" . "  method='post'>";
        ?>
        <div class="mb-3">
            <label>Payer Email</label>
            <input type="text" class="form-control" name='price' value=<?php echo $_SESSION['payment_data']["Payer_Email"] ?> readonly>

        </div>

        <div class="mb-3">
            <label for="item_id"><?php
                                    if ($_SESSION['payment_data']['Payment_Type'] == PAYMENT_SESSION_REGISTER)   echo "Item_Id/Session_id";
                                    elseif ($_SESSION['payment_data']['Payment_Type'] == PAYMENT_COACH_REGISTER)   echo "Item_Id/Coach Email";
                                    ?></label>
            <?php
            if (!($_SESSION['payment_data']['Payment_Type'] == PAYMENT_SESSION_CREATE))
                echo "<input type='text' class='form-control' value={$_SESSION['payment_data']['Item_id']} readonly>";
            ?>
        </div>

        <div class="mb-3">
            <label for="price">Price ($)</label>
            <input type="text" class="form-control" name='price' value=<?php echo $_SESSION['payment_data']["Amount"] ?> readonly>
        </div>


        <div class="m-3">
            <input type="submit" class="btn btn-primary" value='Enter Payment Details'>
        </div>
        </form>

    </div>
    <?php
    require_once 'public/html/footer.html';
    ?>

</body>

</html>