<?php
$payAddress = "";
if (isset($_SESSION['payment_flag'])) {
    if ($_SESSION['payment_flag'] === "createSession")
        $payAddress = BASE_DIR . "Payment/session/1";
    elseif ($_SESSION['payment_flag'] === "registerSession")
        $payAddress = BASE_DIR . "Payment/session/1";
    elseif ($_SESSION['payment_flag'] === "coachRegister")
        $payAddress = BASE_DIR . "Payment/coachRegister/1";
    // echo $payAddress;
    // print_r($_SESSION['payment_flag']);
}
//echo $payAddress;
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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/pay.css" ?>>
    <title>Payment</title>
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
                <a href="#" class="nav-item nav-link">Messages</a>


                <a href=<?= BASE_DIR . "Auth/logout" ?> class="nav-item nav-link">Log Out</a>

            </div>
        </div>
    </div>
</nav>

<body>



    <div class="container ">
        <div class="card px-4">
            <p class="h8 py-3">Payment Details</p>
            <div class="row gx-3">
                <form action=<?= $payAddress; ?> method="post">
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Person Name</p> <input class="form-control mb-3" type="text" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Card Number</p> <input class="form-control mb-3" type="text" placeholder="1234 5678 435678">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Expiry</p> <input class="form-control mb-3" type="text" placeholder="MM/YYYY">
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">CVV/CVC</p> <input class="form-control mb-3 pt-2 " type="password" placeholder="***">
                            </div>
                        </div>
                    </div>
                    <!--        <div class="col-12">
                        <div class="btn btn-primary mb-3"> <span class="ps-3"><input type="submit" value="Pay"></span> <span class="fas fa-arrow-right"></span> </div>
                    </div>   -->
                    <div class="col-12">
                        <input class="btn btn-primary mb-3" type="submit" value="Pay">
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>