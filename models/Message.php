<?php

class Message extends Model{

function __construct($id){
    parent::__construct();
    $this->id = $id;
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



}
?>