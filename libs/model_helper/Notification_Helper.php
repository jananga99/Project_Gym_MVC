<?php

class Notification_Helper extends Helper{

function __construct(){
    parent::__construct();
}

//Returns all notifictaions for given email
function getNotifications($email,$type_read){
    if($type_read==="all")
        return $this->db->select("Notifications",array("Details","Notification_id","Mark_As_Read"),
        array("Receiver_Email"=>$email,"Delected"=>'0'));
    elseif($type_read==="read")
        return $this->db->select("Notifications",array("Details","Notification_id","Mark_As_Read"),
        array("Receiver_Email"=>$email,"Mark_As_Read"=>'1',"Delected"=>'0'));   
    elseif($type_read==="unread") 
        return $this->db->select("Notifications",array("Details","Notification_id","Mark_As_Read"),
        array("Receiver_Email"=>$email,"Mark_as_read"=>'0',"Delected"=>'0'));        
}


//Get the latest created session by logged in coach
function getLatestNotificationId(){
    return $this->db->select("notifications",array("Notification_id"),array("Delected"=>'0'),1,"Notification_id",1)['Notification_id'];
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