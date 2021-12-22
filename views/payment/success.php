<?php
$backAddress = "";
if (isset($_SESSION['back_flag'])) {
    if ($_SESSION['back_flag'] === "createSession")
        $backAddress = BASE_DIR . "Session/create";
    elseif ($_SESSION['back_flag'] === "registerSession")
        $backAddress = BASE_DIR . "Session/view";
    elseif ($_SESSION['back_flag'] === "coachRegister")
        $backAddress = BASE_DIR . "Customer/coach/search";
}
// echo $backAddress;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/payment.css" ?>>
    <title>Payment Success</title>
</head>

<body>
    <div class="container">

        <div class="m-6">
            <h1>PAYMENT SUCCESS</h1>
        </div>

        <a class="btn btn-primary" href=<?= $backAddress; ?>>Go back to registerd session</a>

    </div>


</body>

</html>