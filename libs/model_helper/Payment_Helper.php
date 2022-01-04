<?php

class Payment_Helper extends Helper{

function __construct(){
    parent::__construct();
}

//Gets price for given name
function getPrice($type){
    return $this->db->select("price",array("price"),array("Price_Type"=>$type,"Delected"=>0),1)['price'];
}



}



?>