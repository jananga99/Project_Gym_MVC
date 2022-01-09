<?php


class Session extends Model implements Observable{

function __construct($data=-1){
    parent::__construct();
    if($data!=-1){
        if(isset($data['id']) && !(is_null($data['id'])) ){
            $this->id=$data['id'];
        }else{
            $this->create($data['create_data']);
            $this->id = $this->helper_factory->getHelper("Session")->getLatestCreatedSession($_POST['create_data']['Coach_Email']);   
            $this->init();
        }
        $this->observers = array();
    }
}


function init(){
    $this->notifyObservers(NOTIFICATION_SESSION_CREATE);
}


//Inserts given session details to database
function create($data){
    $this->db->insert("session_details",$data,'ssssssds');
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


//Sets Customer observers for the session
function setCustomerObservers($notificationType){
    $factory = new Factory();
    if($notificationType===NOTIFICATION_SESSION_CREATE)
        foreach( $this->helper_factory->getHelper("Coach_Registration")->registeredCustomers($this->getCreatedCoach()) as $row ) 
            $this->observers[] = $factory->getModel("Customer",array('id'=>$row['Customer']));
    elseif($notificationType===NOTIFICATION_SESSION_DELETE || $notificationType===NOTIFICATION_SESSION_EDIT)
        foreach( $this->registeredCustomers() as $customer ) 
            $this->observers[] = $factory->getModel("Customer",array('id'=>$customer));   
}


//Sets Coach observers for the session
function setCoachObservers($notificationType){ 
    $factory = new Factory();
    $this->observers[] = $factory->getModel("Coach",array('id'=>$this->getCreatedCoach()));
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
        $observer->update(array('rec_email'=>$rec_email,
        'details'=>$this->helper_factory->getHelper("Notification")->createNotificationDetails($type,$notification_data),'type'=>$type)); 
    }
   
}


//////////////////Helper Functions///////////////////////

//Returns the coach who created the session 
function getCreatedCoach(){
    return $this->helper_factory->getHelper("Session")->getCreatedCoach($this->id);    
}


//Get the Session data
function getData(){
    return $this->helper_factory->getHelper("Session")->getData($this->id);
}


//Returns all customers registered for the sesssion
function registeredCustomers(){
    return $this->helper_factory->getHelper("Session")->registeredCustomers($this->id);
}



//Get the latest created session by logged in coach
function getLatestCreatedSession($coach){
    return $this->helper_factory->getHelper("Session")->getLatestCreatedSession($coach);
}


//Returns Sessions id if given customer registered for session
function isCustomerRegistered($customer,$session_id){
    return $this->helper_factory->getHelper("Session")->isCustomerRegistered($customer,$session_id);
}


//Returns al registered sessions by given customer email
function registeredSessions($email){
    return $this->helper_factory->getHelper("Session")->registeredSessions($email);
}


//Returns all unregistered sessions by given customer email
function unregisteredSessions($email){
    return $this->helper_factory->getHelper("Session")->unregisteredSessions($email);  
}


//Get the Session data for given session_id
function getSessionData($session_id){
    return $this->helper_factory->getHelper("Session")->getSessionData($session_id);
}


//Returns created sessions for given coach_email
function createdSessions($email){
    return $this->helper_factory->getHelper("Session")->createdSessions($email);
}


//Returns all the sessions
function getAllSessions(){
    return $this->helper_factory->getHelper("Session")->getAllSessions();  
}


//Returns registered coaches for given customer eail
function registeredCoachesForCustomer($email){
    return $this->helper_factory->getHelper("Coach_Registration")->registeredCoaches($email);
}


//Gets price for given name
function getPrice($type){
    return $this->helper_factory->getHelper("Payment")->getPrice($type);
}


}
?>