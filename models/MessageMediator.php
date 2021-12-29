<?php

class MessageMediator extends Model implements Mediator{

    private $users=0;

    function __construct(){
        parent::__construct();
        $this->users = array();
    }


    //Adds a user
    function addUser($user){
        $this->users[] = $user;
    }


    //Checks whether the given user is added for mediator
    function isUserAdded($user){
        foreach($this->users as $u){
            if($u->email===$user->email)
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
                "Sender_Email"=>$sender->getEmail(),"Details"=>$message),'sss');    
            }
        }
    }
    
}




?>