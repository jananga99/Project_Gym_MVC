<?php

class Payment extends Model{

function __construct($data){
    parent::__construct();
    if(isset($data['id']) && !(is_null($data['id'])) ){
        $this->id=$data['id'];
    }else{
        $this->addPayment($data['create_data']);
        $this->id = $this->helper_factory->getHelper("Payment")->getLatestPaymentId($data['create_data']['Payer_Email']);   
    }
}


//adds payment to database
function addPayment($data){
    $this->db->insert("payment",$data,"sddd");
}


//Adds a price
function addPrice($data){
    $this->db->insert("price",$data,"sss");    
}


//get prices
function getPrices(){
    return $this->db->select("price",0,array("Delected"=>0));
}


//Edits prices
function editPrice($id,$data){
    $this->db->update("price",$data,array("Price_id"=>$id),'sss');
}


//$deletes a price
function deletePrice($id){
    $this->db->update("price",array("Delected"=>1),array("Price_id"=>$id),'d');
}











}
?>