<?php

class Notification extends Model{

function __construct($data){
    parent::__construct();
    if(isset($data['id']) && !(is_null($data['id'])) ){
        $this->id=$data['id'];
    }else{
        $this->create($data['create_data'],$data['create_data_types']);
        $this->id = $this->helper_factory->getHelper("Notification")->getLatestNotificationId();   
    }
}


//Inserts a notification to database
function create($data,$types){    
    $this->db->insert("notifications",$data,$types);
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