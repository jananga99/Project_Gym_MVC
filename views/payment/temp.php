<?php
$arr =  $_SESSION['session_create_data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>TEMP PAGE UNTIL</h1>

    <!--<form action=<?= BASE_DIR . "Payment/session/1" ?> method="post">-->
    <?php
    
    if($_SESSION['data']['flag']==="create_session")
        echo "<form action= ".BASE_DIR."Payment/pay/createSession"."  method='post'>";
    elseif($_SESSION['data']['flag']==="register_session")
        echo "<form action=".BASE_DIR."Payment/pay/registerSession"."  method='post'>";

    ?>
        <label for="price">Price</label>
        <input type="text" class="form-control" name='price' value=<?php echo $arr["price"] ?> readonly>
        <input type="submit" class="btn btn-block btn-login" value='Enter Payment Details'>
    </form>

</body>

</html> 