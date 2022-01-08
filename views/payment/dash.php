<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/pay.css" ?>>
    <title>Payment</title>
</head>


<body>

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>




    <div class="container ">
        <div class="card px-4">
            <p class="h8 py-3">Payment Details</p>
            <div class="row gx-3">
                <form action=<?= BASE_DIR."Payment/pay"; ?> method="post">
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Person Name</p> <input class="form-control mb-3" name='name' type="text" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Card Number</p> <input class="form-control mb-3" name="card_number" type="text" placeholder="1234 5678 435678">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Expiry</p> <input class="form-control mb-3" name="expiry" type="text" placeholder="MM/YYYY">
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">CVV/CVC</p> <input class="form-control mb-3 pt-2 " name="cvc" type="password" placeholder="***">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary mb-3" type="submit" value="Pay">
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php
    require_once 'public/html/footer.html';
    ?>

</body>

</html>