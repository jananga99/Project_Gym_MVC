<?php
require_once 'models/User.php';
class Customer extends User{

function __construct($email,$mediator=0){
    parent::__construct("Customer",$email,$mediator);
}


//Observer
function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Customer","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}



}
?>