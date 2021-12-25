<?php
require "models/Coach.php";
require "models/Customer.php";
require "models/Admin.php";
class Message extends Model{

function __construct(){
    parent::__construct();
}

function getReceievedMessages($email){
    return $this->db->select("Messages",array("Details","Message_id","Sender_Email"),array("Receiver_Email"=>$email,"Delected"=>'0'));
}

function getSentMessages($email){
    return $this->db->select("Messages",array("Details","Message_id","Receiver_Email"),array("Sender_Email"=>$email,"Delected"=>'0'));
}


function markAsRead($id){
    $this->db->update("Messages",array("Mark_As_Read"=>'1'),array("Message_id"=>$id),'d');    
}

//MAKE ALL MESSAGES DELEECT WHEN DELECT SELECT MESSAGE
//TODo
function delete($id){
    $this->db->update("Messages",array("Delected"=>'1'),array("Message_id"=>$id),'d');    
}

//Mediator
function send($data){
    $coach = new Coach(new MessageMediator());
    foreach( $this->db->select("Registration",array("Customer"),array("Coach"=>$data['coach_email'])) as $row ) {
        $c = new Customer($coach->messageMediator);
        $c->email = $row['Customer'];
        if(!$coach->messageMediator->isUserAdded($c))
            $coach->messageMediator->addUser($c);
    }
    $msg = array();
    $msg['send_email'] = $data['coach_email'];
    $msg['details'] = $data['details'];     
    $coach->sendMessage($msg);

}










}
?>