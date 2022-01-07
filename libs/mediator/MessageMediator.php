<?php


class MessageMediator implements Mediator{

private $users=0;

function __construct(){
    $this->db = Database::getInstance();
    $this->db->create(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    $this->users = array();
}


//Adds a user
function addUser($user){
    $this->users[] = $user;
}


//Checks whether the given user is added for mediator
function isUserAdded($user){
    foreach($this->users as $u){
        if($u->getEmail()===$user->getEmail())
            return 1;
    }
    return 0;
}


///Sends message using mediator
function sendMessage($message,$sender){
    foreach($this->users as $u){
        if(!($u->getEmail()===$sender->getEmail())){
            $u->receieveMessage($message);
            $this->db->insert("messages",array("Receiver_Email"=>$u->getEmail(),
            "Sender_Email"=>$sender->getEmail(),"Message"=>$message['data'],
            "Type"=>$message['type'],"message_sent_id"=>$message['sent_id']),'sssdd');    
        }
    }
}

}



?>