<?php
require_once 'models/User.php';
class Coach extends User implements Observer{

function __construct($email,$mediator=0){
    parent::__construct("Coach",$email,$mediator);
}




//Observer
public function update($data){
    $this->db->insert("notifications",array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Coach","Notification_Type"=>$data['type'],"Details"=>$data['details']),'ssss');
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}



}
