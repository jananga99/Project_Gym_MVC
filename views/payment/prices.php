<?php
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);

$prices = array();
if (isset($_SESSION['data']))
    $prices = $_SESSION['data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/sessions.css" ?>>

    <title>Prices</title>
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

        <h3 class="mb-3">Add Price</h3>
        <form action=<?= BASE_DIR . "Payment/setPrice/create" ?> method="post">
            <label for="price_type">Price Type</label>
            <input type="text" name='price_type'>
            <label for="price">Price</label>
            <input type="text" name='price'>
            <label for="price_details">Price Details</label>
            <input type="text" name='price_details'>
            <input class="btn btn-primary btn-sm" type="submit" value="Add">
        </form>

        <h3 class="mb-3">Prices</h3>
        <?php
        foreach ($prices as $row) {
            echo "
            <div class='mb-3'>
        <form action=" . BASE_DIR . "Payment/setPrice/edit method='post'>
            <input type='text' name='price_id' value={$row['Price_id']} readonly style='display:none'>
            <label for='price_type'>Price Type</label>
            <input type='text' name='price_type' value={$row['Price_Type']}>
            <label for='price'>Price</label>
            <input type='text' name='price' value={$row['Price']}>
            <label for='price_details'>Price Details</label>
            <input type='text' name='price_details' value={$row['Details']}>
            <input class='btn btn-primary btn-sm' type='submit' value='Edit'>
        </form>
        <form action=" . BASE_DIR . "Payment/setPrice/delete method='post'>
            <input type='text' name='price_id' value={$row['Price_id']} readonly style='display:none'>
            <input class='btn btn-danger btn-sm' type='submit' value='Delete'>
        </form>
        </div>
        ";
        }
        ?>
    </div>

    <div class="d-flex justify-content-center" >
        <p><?= $msg ?></p>
    </div>

    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

</html>