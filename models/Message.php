<?php

class Message extends Model{

function __construct($data=-1){
    parent::__construct();
    if($data!=-1){
        if(isset($data['id']) && !(is_null($data['id'])) ){
            $this->id=$data['id'];
        }else{
            $this->send($data['create_data']['sender_email'],$data['create_data']['message_type'],$data['create_data']['message']);
            $this->id =  $this->helper_factory->getHelper("Message")->getLatestSentMessage($data['create_data']['sender_email']);   
        }
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
    $sender->sendMessage(array("data"=>$message,"type"=>$message_type,"sent_id"=>$this->helper_factory->getHelper("Message")->getLatestSentMessage($sender_email)));
}


//Set receievers for Mediator according to sendeing type
function setReceievers($message_type,$mediator,$coach_email=0){
    //echo $message_type;
    if($message_type==MESSAGE_COACH_TO_REGISTERED_CUSTOMERS){
        $factory = new Factory();
        foreach( $this->helper_factory->getHelper("Coach_Registration")->registeredCustomers($coach_email) as $row ) {
            $customer = $factory->getModel("Customer",array('id'=>$row['Customer'],'mediator'=>$mediator));
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);
        }
    }elseif($message_type==MESSAGE_COACH_TO_ALL_CUSTOMERS || $message_type==MESSAGE_ADMIN_TO_ALL_CUSTOMERS){
        $factory = new Factory();
        foreach($this->helper_factory->getHelper("Customer")->getAllCustomers() as $customer_email){
            $customer = $factory->getModel("Customer",array('id'=>$customer_email,'mediator'=>$mediator));
            if(!$mediator->isUserAdded($customer))
                $mediator->addUser($customer);            
        }
    }elseif($message_type==MESSAGE_ADMIN_TO_ALL_COACHES){
        $factory = new Factory();
        foreach($this->helper_factory->getHelper("Coach")->getAllCoaches() as $email){
            $coach = $factory->getModel("Coach",array('id'=>$email,'mediator'=>$mediator));
            if(!$mediator->isUserAdded($coach))
                $mediator->addUser($coach);            
        }
    }
} 


///////////Helper Functions///////////////

//Returns received messages for given email
function getReceievedMessages($email,$type_read="all"){ 
    return $this->helper_factory->getHelper("Message")->getReceievedMessages($email,$type_read);
}


//Returns sent messages for given email
function getSentMessages($email){
    return $this->helper_factory->getHelper("Message")->getSentMessages($email);
}


//Returns the type of given message id
function getMessageType($id){
    return $this->helper_factory->getHelper("Message")->getMessageType($id);
}


//Get the latest sent message
function getLatestSentMessage($sender){
    return $this->helper_factory->getHelper("Message")->getLatestSentMessage($sender);
}







}
?>