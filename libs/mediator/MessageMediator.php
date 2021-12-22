<?php

require 'Mediator.php';

class MessageMediator implements Mediator{

    private $users=0;

    function __construct(){
        $this->users = array();
    }

        //TODO
    function addUser($user){
        $this->users[] = $user;
    }

        //TODO
    function isUserAdded($user){
        foreach($this->users as $u){
            if($u->email===$user->email)
                return 1;
        }
        return 0;
    }

    ///TODO
    function sendMessage($msg,$user){
        foreach($this->users as $u){
            if(!($u->email===$user->email))
                $u->receieveMessage($msg);
        }
    }
    
}




?>