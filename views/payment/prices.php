<?php
$prices=array();
if(isset($_SESSION['data']))
    $prices = $_SESSION['data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prices</title>
</head>
<body>
    
    <h3>Add Price</h3>
    <form action=<?=BASE_DIR."Payment/setPrice/create"?> method="post">
        <label for="price_type">Price Type</label>
        <input type="text" name='price_type'>
        <label for="price">Price</label>
        <input type="text" name='price'>
        <label for="price_details">Price Details</label>
        <input type="text" name='price_details'>
        <input type="submit" value="Add">
    </form>

    <h3>Prices</h3>
    <?php
    foreach ($prices as $row) {
        echo "
        <form action=".BASE_DIR."Payment/setPrice/edit method='post'>
            <input type='text' name='price_id' value={$row['Price_id']} readonly style='display:none'>
            <label for='price_type'>Price Type</label>
            <input type='text' name='price_type' value={$row['Price_Type']}>
            <label for='price'>Price</label>
            <input type='text' name='price' value={$row['Price']}>
            <label for='price_details'>Price Details</label>
            <input type='text' name='price_details' value={$row['Details']}>
            <input type='submit' value='Edit'>
        </form>
        <form action=".BASE_DIR."Payment/setPrice/delete method='post'>
            <input type='text' name='price_id' value={$row['Price_id']} readonly style='display:none'>
            <input type='submit' value='Delete'>
        </form>
        ";
    }
    ?>

</body>
</html>