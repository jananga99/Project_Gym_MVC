<?php

class Message extends Model{

function __construct($data){
    parent::__construct();
    if(isset($data['id']) && !(is_null($data['id'])) ){
        $this->id=$data['id'];
    }else{
        $this->send($data['create_data']['sender_email'],$data['create_data']['message_type'],$data['create_data']['message']);
        $message_helper =  new Message_Helper();
        $this->id = $message_helper->getLatestSentMessage($data['create_data']['sender_email']);   
    }
}


//Marks this message as read.
function markAsRead(){
    $this->db->update("Messages",array("Mark_As_Read"=>'1'),array("Message_id"=>$this->id),'d');    
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


//Mediator Design Pattrns
//Sends (broadcasts) messages
function send($sender_email,$message_type,$message){
    if($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS)
        $sender_type = "Coach";
    elseif ($message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_COACHES)
        $sender_type = "Admin";
    $factory = new Factory();
    $sender = $factory->getModel($sender_type,array('id'=>$sender_email,'mediator'=>new MessageMediator() ) );
    $this->db->insert("sent_messages",array("Sender_Email"=>$sender_email,"Message"=>$message,
    "Type"=>$message_type),'ssd');       
    $this->setReceievers($message_type,$sender->getMessageMediator(),$sender_email);
    $message_helper =  new Message_Helper();
    $sender->sendMessage(array("data"=>$message,"type"=>$message_type,"sent_id"=>$message_helper->getLatestSentMessage($sender_email)));
}


//Set receievers for Mediator according to sendeing type
function setReceievers($message_type,$mediator,$coach_email=0){
    //echo $message_type;
    if($message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS){
        $factory = new Factory();
        $coach_Registration = new Coach_Registration_Helper();
        foreach( $coach_Registration->registeredCustomers($coach_email) as $row ) {
            $customer = $factory->getModel("Customer",array('id'=>$row['Customer'],'mediator'=>$mediator));
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);
        }
    }elseif($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS){
        $customer_helper = new Customer_Helper();
        $factory = new Factory();
        foreach($customer_helper->getAllCustomers() as $customer_email){
            $customer = $factory->getModel("Customer",array('id'=>$customer_email,'mediator'=>$mediator));
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);            
        }
    }elseif($message_type==MESSAGE_ADMIN_TO_ALL_COACHES){
        $coach_helper = new Coach_Helper();
        $factory = new Factory();
        foreach($coach_helper->getAllCoaches() as $email){
            $coach = $factory->getModel("Coach",array('id'=>$email,'mediator'=>$mediator));
            if(!$mediator->isUserAdded($coach))
                $mediator->addUser($coach);            
        }
    }
} 


}
?>