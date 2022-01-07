<?php

class Message_Helper extends Helper{

function __construct(){
    parent::__construct();
}

//Returns received messages for given email
function getReceievedMessages($email,$type_read="all"){ 
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
function getSentMessages($email){
    return $this->db->select("sent_messages",array("Message","Message_Sent_id","Type"),
    array("Sender_Email"=>$email,"Sender_Delected"=>'0'));
}


//Returns the type of given message id
function getMessageType($id){
    return $this->db->select("Messages",array("Type"),array("Message_id"=>$id),1)["Type"];
}


//Get the latest sent message
function getLatestSentMessage($sender){
    return $this->db->select("Sent_messages",array("Message_sent_id"),array("Sender_Email"=>$sender),1,"Message_sent_id",1)['Message_sent_id'];
}


//Set receievers for Mediator according to sendeing type
function setReceievers($message_type,$mediator,$coach_email=0){
    //echo $message_type;
    if($message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS){
        $factory = new Factory();
        $coach_Registration = new Coach_Registration_Helper();
        foreach( $coach_Registration->registeredCustomers($coach_email) as $row ) {
            $factory = new Factory();
            $customer = $factory->getModel("Customer",$row['Customer'],$mediator);
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);
        }
    }elseif($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS){
        $customer_helper = new Customer_Helper();
        foreach($customer_helper->getAllCustomers() as $customer_email){
            $factory = new Factory();
            $customer = $factory->getModel("Customer",$customer_email,$mediator);
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);            
        }
    }elseif($message_type==MESSAGE_ADMIN_TO_ALL_COACHES){
        $coach_helper = new Coach_Helper();
        foreach($coach_helper->getAllCoaches() as $email){
            $factory = new Factory();
            $coach = $factory->getModel("Coach",$email,$mediator);
            if(!$mediator->isUserAdded($coach))
                $mediator->addUser($coach);            
        }
    }
} 
    
//Mediator Design Pattrns
//Sends (broadcasts) messages
function send($sender_email,$message_type,$message){
    if($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS)
        $sender_type = "Coach";
    elseif ($message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_COACHES)
        $sender_type = "Admin";
    $factory = new Factory();
    $sender = $factory->getModel($sender_type,$sender_email,new MessageMediator());
    $this->db->insert("sent_messages",array("Sender_Email"=>$sender_email,"Message"=>$message,
    "Type"=>$message_type),'ssd');       
    $this->setReceievers($message_type,$sender->getMessageMediator(),$sender_email);
    $sender->sendMessage(array("data"=>$message,"type"=>$message_type,"sent_id"=>$this->getLatestSentMessage($sender_email)));
}





}














?>