<?php

class Payment extends Model{

function __construct($data=-1){
    parent::__construct();
    if($data!=-1){
        if(isset($data['id']) && !(is_null($data['id'])) ){
            $this->id=$data['id'];
        }else{
            $this->addPayment($data['create_data']);
            $this->id = $this->helper_factory->getHelper("Payment")->getLatestPaymentId($data['create_data']['Payer_Email']);   
        }
    }
}


//adds payment to database
function addPayment($data){
    $this->db->insert("payment",$data,"sdds");

    // $this->db->insert("payment",$data);

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



/////////Helper Functions////////////////


//Gets price for given name
function getPrice($type){
    return $this->helper_factory->getHelper("Payment")->getPrice($type);
}


//Get the latest sent message
function getLatestPaymentId($payer_email){
    return $this->helper_factory->getHelper("Payment")->getLatestPaymentId($payer_email);
}








}
?>