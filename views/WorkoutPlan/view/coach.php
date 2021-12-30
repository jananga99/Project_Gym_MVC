<?php
$plan = $_SESSION['data']; 
$customer_sarr = $_SESSION['customer_arr'];


echo "<pre>";
print_r($plan['Plan']);
echo "</pre>";


echo "<pre>";
print_r($customer_sarr);
echo "</pre>";
?>