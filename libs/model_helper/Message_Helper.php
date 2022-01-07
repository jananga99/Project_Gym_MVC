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



    






}














?>