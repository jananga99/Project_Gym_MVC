<?php

class Message extends Model{

function __construct($id){
    parent::__construct();
    $this->id = $id;
}


//Returns received messages for given email
static function getReceievedMessages($email,$type_read="all"){ 
    if($type_read==="all")
        return $this->db->select("Messages",array("Message","Message_id","Sender_Email",
        "Type","Mark_as_read"),array("Receiver_Email"=>$email,"Receiver_Delected"=>'0'));
    elseif($type_read==="read")
        return $this->db->select("Messages",array("Message","Message_id","Sender_Email",
        "Type","Mark_as_read"),array("Receiver_Email"=>$email,"Receiver_Delected"=>'0',"Mark_as_read"=>1));
    elseif($type_read==="unread")
        return $this->db->select("Messages",array("Message","Message_id","Sender_Email",
        "Type","Mark_as_read"),array("Receiver_Email"=>$email,"Receiver_Delected"=>'0',"Mark_as_read"=>0));
}


//Returns sent messages for given email
static function getSentMessages($email){
    return $this->db->select("sent_messages",array("Message","Message_Sent_id","Type"),
    array("Sender_Email"=>$email,"Sender_Delected"=>'0'));
}


//Marks this message as read.
function markAsRead(){
    $this->db->update("Messages",array("Mark_As_Read"=>'1'),array("Message_id"=>$this->id),'d');    
}


//Returns the type of given message id
static function getMessageType($id){
    return $this->db->select("Messages",array("Type"),array("Message_id"=>$id),1)["Type"];
}


//Deletes this message
function delete($type){  
    if($type==="rec")
        $this->db->update("Messages",array("Receiver_Delected"=>'1'),array("Message_id"=>$this->id),'d'); 
    elseif($type==="sent_me" || $type==="sent_everyone"){
        $this->db->update("sent_messages",array("Sender_Delected"=>'1'),array("Message_Sent_id"=>$this->id),'d');
        if($type==="sent_everyone") 
            $this->db->update("Messages",array("Receiver_Delected"=>'1'),array("Message_Sent_id"=>$this->id),'d');
    }
}

//Get the latest sent message
static function getLatestSentMessage($sender){
    return $this->db->select("Sent_messages",array("Message_sent_id"),array("Sender_Email"=>$sender),1,"Message_sent_id",1)['Message_sent_id'];
}


//Set receievers for Mediator according to sendeing type
static function setReceievers($message_type,$mediator,$coach_email=0){
    //echo $message_type;
    if($message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS){
        $factory = new Factory();
        $coach_Registration = $factory->getModel("Coach_Registration");
        foreach( $coach_Registration->registeredCustomers($coach_email) as $row ) {
            $customer = new Customer($row['Customer'],$mediator);
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);
        }
    }elseif($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS){
        $customer_helper = new Customer_Helper();
        foreach($customer_helper->getAllCustomers() as $customer_email){
            $customer = new Customer($customer_email,$mediator);
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);            
        }
    }elseif($message_type==MESSAGE_ADMIN_TO_ALL_COACHES){
        $coach_helper = new Coach_Helper();
        foreach($coach_helper->getAllCoaches() as $email){
            $coach = new Coach($email,$mediator);
            if(!$mediator->isUserAdded($coach))
                $mediator->addUser($coach);            
        }
    }
    
}


//Mediator Design Pattrns
//Sends (broadcasts) messages
static function send($sender_email,$message_type,$message){
    if($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS)
        $sender_type = "Coach";
    elseif ($message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_COACHES)
        $sender_type = "Admin";
    $sender = new $sender_type($sender_email,new MessageMediator());
    $this->db->insert("sent_messages",array("Sender_Email"=>$sender_email,"Message"=>$message,
    "Type"=>$message_type),'ssd');       
    self::setReceievers($message_type,$sender->getMessageMediator(),$sender_email);
    $sender->sendMessage(array("data"=>$message,"type"=>$message_type,"sent_id"=>self::getLatestSentMessage($sender_email)));
}










}
?>