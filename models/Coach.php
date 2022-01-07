<?php
require_once 'models/User.php';
class Coach extends User implements Observer{

function __construct($data){
    parent::__construct("Coach",$data);
}




//Observer
public function update($data){
    $factory = new Factory();
    $data1=array();
    $data1['create_data'] = array("Receiver_Email"=>$data['rec_email'],"Receiver_Type"=>"Coach","Notification_Type"=>$data['type'],"Details"=>$data['details']);
    $data1['create_data_types'] = 'ssss';
    $factory->getModel("Notification",$data1);
}


//Mediator
//Receieves the sent message
function receieveMessage($data){      
    
}



}
