<?php

class Payment extends Model{

function __construct(){
    parent::__construct();
}


//adds payment to database
function addPayment($data){
    $this->db->insert("payment",$data,"sddd");
}












}
?>