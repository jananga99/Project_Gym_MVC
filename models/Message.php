<?php

class Message extends Model{

function __construct($id){
    parent::__construct();
    $this->id = $id;
}


//Returns received messages for given email
static function getReceievedMessages($email){
    return self::$dbStatic->select("Messages",array("Details","Message_id","Sender_Email"),
    array("Receiver_Email"=>$email,"Delected"=>'0'));
}


//Returns sent messages for given email
static function getSentMessages($email){
    return self::$dbStatic->select("Messages",array("Details","Message_id","Receiver_Email"),
    array("Sender_Email"=>$email,"Delected"=>'0'));
}


//Marks this message as read.
function markAsRead(){
    $this->db->update("Messages",array("Mark_As_Read"=>'1'),array("Message_id"=>$this->id),'d');    
}


//Deletes this message
function delete(){
    $this->db->update("Messages",array("Delected"=>'1'),array("Message_id"=>$this->id),'d');    
}


//Set receievers for Mediator according to sendeing type
static function setReceievers($sender_email,$sender_type,$mediator){
    if($sender_type==="Coach"){
        $coach_Registration = new Coach_Registration();
        foreach( $coach_Registration->registeredCustomers($sender_email) as $row ) {
            $customer = new Customer($row['Customer'],$mediator);
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);
        }
    }
}


//Mediator Design Pattrns
//Sends (broadcasts) messages
static function send($sender_email,$sender_type,$message){
    $sender = new $sender_type($sender_email,new MessageMediator());
    self::setReceievers($sender_email,$sender_type,$sender->messageMediator);
    $sender->sendMessage($message);
}










}
?>