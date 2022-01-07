<?php

class Payment extends Model{

function __construct(){
    parent::__construct();
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