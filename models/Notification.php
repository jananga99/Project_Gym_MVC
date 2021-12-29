<?php

class Notification extends Model{

function __construct(){
    parent::__construct();
}


//Returns all notifictaions for given email
static function getNotifications($email){
    return self::$dbStatic->select("Notifications",array("Details","Notification_id"),
    array("Receiver_Email"=>$email,"Delected"=>'0'));
}


//Returns all unread notifictaions for given email
static function getUnreadNotifications($email){
    return self::$dbStatic->select("Notifications",array("Details","Notification_id"),
    array("Receiver_Email"=>$email,"Mark_as_read"=>'0',"Delected"=>'0'));
}


//Returns all read notifictaions for given email
static function getReadNotifications($email){
    return self::$dbStatic->select("Notifications",array("Details","Notification_id"),
    array("Receiver_Email"=>$email,"Mark_As_Read"=>'1',"Delected"=>'0'));
}


//Mark this notification as read
function markAsRead($id){
    $this->db->update("Notifications",array("Mark_As_Read"=>'1'),array("Notification_id"=>$id),'d');    
}


//Delets this notification
function delete($id){
    $this->db->update("Notifications",array("Delected"=>'1'),array("Notification_id"=>$id),'d');    
}


//Creating a notification details according to given data and notification type
function createNotificationDetails($type,$data){
    if($type===NOTIFICATION_SESSION_REGISTER || $type===NOTIFICATION_SESSION_UNREGISTER){
        $details = $data['customer_email']." Customer ";
        if($type===NOTIFICATION_SESSION_UNREGISTER)   $details.= "unregistered from";
        else   $details.= "registered for";
        $details.=" the Session (Session id = ".$data['id']." )";
    }elseif($type===NOTIFICATION_SESSION_CREATE){
        $details = $data['coach_email']." Coach created a Session (id = ".$data['id']." )";  
    }elseif($type===NOTIFICATION_SESSION_DELETE){
        $details = $data['coach_email']." Coach delected the Session (id = ".$data['id']." ). You will be refunded.";  
    }elseif($type===NOTIFICATION_SESSION_EDIT){
        $details = $data['coach_email']." Coach edited the Session (id = ".$data['id']." )";      
    }
    return $details;
}








}
?>