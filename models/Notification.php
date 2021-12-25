<?php

class Notification extends Model{

function __construct(){
    parent::__construct();
}

function getNotifications($email){
    return $this->db->select("Notifications",array("Details","Notification_id"),array("Receiver_Email"=>$email,"Delected"=>'0'));
}

function markAsRead($id){
    $this->db->update("Notifications",array("Mark_As_Read"=>'1'),array("Notification_id"=>$id),'d');    
}

function delete($id){
    $this->db->update("Notifications",array("Delected"=>'1'),array("Notification_id"=>$id),'d');    
}











}
?>