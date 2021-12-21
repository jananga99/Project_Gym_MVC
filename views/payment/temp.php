<?php
$arr = $_SESSION['data'];
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

    <a href=<?= BASE_DIR . "Payment/session/1" ?>>Back</a>

    <form action=<?= BASE_DIR . "Payment/session/1" ?> method="post">
        <label for="select_session">Session number</label>
        <input type="text" class="form-control" name='select_session' value=<?php echo $arr["select_session"] ?> readonly>

        <label for="price">Price</label>
        <input type="text" class="form-control" name='price' value=<?php echo $arr["price"] ?> readonly>
        <input type="submit" class="btn btn-block btn-login" value='Pay to register session'>

    </form>

</body>

</html>