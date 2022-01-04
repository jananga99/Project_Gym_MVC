<?php

class Notification extends Model{

function __construct($id){
    parent::__construct();
    $this->id = $id;
}


//Mark this notification as read
function markAsRead(){
    $this->db->update("Notifications",array("Mark_As_Read"=>'1'),array("Notification_id"=>$this->id),'d');    
}


//Delets this notification
function delete(){
    $this->db->update("Notifications",array("Delected"=>'1'),array("Notification_id"=>$this->id),'d');    
}











}
?>