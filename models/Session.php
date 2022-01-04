<?php


class Session extends Model implements Observable{

function __construct($id){
    parent::__construct();
    $this->id = $id;
    $this->observers = array();
}


function init(){
    $this->notifyObservers(NOTIFICATION_SESSION_CREATE);
}


//Returns the coach who created the session 
function getCreatedCoach(){
    return $this->db->select("session_details",array("Coach_Email"),
    array("Session_id"=>$this->id),1)['Coach_Email'];    
}


//Get the Session data
function getData(){
    return $this->db->select("session_details",0,array("Session_id"=>$this->id,"Delected"=>'0'),1);
}


//Deletes the session
function delete(){
    $this->notifyObservers(NOTIFICATION_SESSION_DELETE);
    $this->db->update("Session_details",array("Delected"=>'1'),array("Session_id"=>$this->id,"Delected"=>'0'),'d');
    $this->db->update("Session_registration",array("Delected"=>'1'),array("Session_id"=>$this->id,"Delected"=>'0'),'d');
}


//Edits the sessin details
function edit($data,$dataTypes){
    $this->db->update("Session_details",$data,array("Session_id"=>$this->id,"Delected"=>'0'),$dataTypes);
    $this->notifyObservers(NOTIFICATION_SESSION_EDIT);
}





//Registers given customer for the session
function register($customer){
    $this->db->insert("Session_registration",array("Session_id"=>$this->id,"Customer"=>$customer),"ds");
    $this->notifyObservers(NOTIFICATION_SESSION_REGISTER,array("customer_email"=>$customer));
}


//Unregisters current customer from session
function unregister($customer){
    $this->db->update("Session_registration",array("Delected"=>'1'),array("Session_id"=>$this->id,
    "Customer"=>$customer,"Delected"=>'0'),"d");
    $this->notifyObservers(NOTIFICATION_SESSION_UNREGISTER,array("customer_email"=>$customer));
}





//Returns all customers registered for the sesssion
function registeredCustomers(){
    $customer_arr = array();
    foreach( $this->db->select("Session_Registration",array("Customer"),
    array("Session_id"=>$this->id,"Delected"=>'0')) as $row ) 
        $customer_arr[] = $row['Customer'];
    return $customer_arr;
}


//Sets Customer observers for the session
function setCustomerObservers($notificationType){
    $factory = new Factory();
    $coach_Registration = $factory->getModel("Coach_Registration");
    if($notificationType===NOTIFICATION_SESSION_CREATE)
        foreach( $coach_Registration->registeredCustomers($this->getCreatedCoach()) as $row ) 
            $this->observers[] = $factory->getModel("Customer",$row['Customer']);
    elseif($notificationType===NOTIFICATION_SESSION_DELETE || $notificationType===NOTIFICATION_SESSION_EDIT)
        foreach( $this->registeredCustomers() as $customer ) 
            $this->observers[] = $factory->getModel("Customer",$customer);   
}


//Sets Coach observers for the session
function setCoachObservers($notificationType){ 
    $factory = new Factory();
    $this->observers[] = $factory->getModel("Coach",$this->getCreatedCoach());
}


//Sets observers for the session
function setObservers($notificationType){ 
    if($notificationType===NOTIFICATION_SESSION_DELETE || $notificationType===NOTIFICATION_SESSION_EDIT || $notificationType===NOTIFICATION_SESSION_CREATE)
        $this->setCustomerObservers($notificationType);
    elseif($notificationType===NOTIFICATION_SESSION_REGISTER || $notificationType===NOTIFICATION_SESSION_UNREGISTER)
        $this->setCoachObservers($notificationType);
}


//Observable
function notifyObservers($type,$data=0){
    $this->setObservers($type);
    foreach($this->observers as $observer){
        $notification_data = array('id'=>$this->id);
        if($type===NOTIFICATION_SESSION_REGISTER || $type===NOTIFICATION_SESSION_UNREGISTER){
            $rec_email = $this->getCreatedCoach();
            $notification_data['customer_email'] = $data['customer_email'];
        }elseif($type===NOTIFICATION_SESSION_CREATE || NOTIFICATION_SESSION_DELETE || NOTIFICATION_SESSION_EDIT ){
            $rec_email = $observer->getEmail();
            $notification_data['coach_email'] = $this->getCreatedCoach();
        }
        $notification_helper = new Notification_Helper();
        $observer->update(array('rec_email'=>$rec_email,
        'details'=>$notification_helper->createNotificationDetails($type,$notification_data),'type'=>$type)); 
    }
   
}

}
?>