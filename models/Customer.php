<?php
require_once 'models/User.php';
class Customer extends User{

function __construct($data){
    parent::__construct("Customer",$data);
}


//Observer
function update($data){
    $factory = new Factory();
    $data1=array();
    $data1['create_data'] = array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Customer","Notification_Type"=>$data['type'],"Details"=>$data['details']);
    $data1['create_data_types'] = 'ssss';
    $factory->getModel("Notification",$data1);
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}



}
?>