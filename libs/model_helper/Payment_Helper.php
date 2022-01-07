<?php

class Payment_Helper extends Helper{

function __construct(){
    parent::__construct();
}

//Gets price for given name
function getPrice($type){
    return $this->db->select("price",array("price"),array("Price_Type"=>$type,"Delected"=>0),1)['price'];
}


//Get the latest sent message
function getLatestPaymentId($payer_email){
    return $this->db->select("payment",array("Payment_id"),array("Payer_Email"=>$payer_email),1,"Payment_id",1)['Payment_id'];
}


}



?>