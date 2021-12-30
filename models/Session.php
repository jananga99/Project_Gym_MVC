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


//Inserts given user details to database
static function create($data){
    self::$dbStatic->insert("session_details",$data,'ssssssds');
    $created_Session = new Session(self::getLatestCreatedSession($data['Coach_Email']));
    $created_Session->init();
}


//Returns created sessions for given coach_email
static function createdSessions($email){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time",
    "Num_Participants","Price","Details");
    return self::$dbStatic->select("session_details",$fields,array("Coach_Email"=>$email,"Delected"=>'0'));
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


//Get the Session data for given session_id
static function getSessionData($session_id){
    return self::$dbStatic->select("session_details",0,array("Session_id"=>$session_id,"Delected"=>'0'),1);
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


//Returns all the sessions
function getAllSessions($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Session_id","Coach_Email","Session_Name","Date","Start_Time","End_Time",
    "Num_Participants","Price","Details");
    if($sort_arr==0)    $sort_arr=array();
    $sort_arr['Delected'] = '0';
    return self::$dbStatic->select("session_details",$fields,$sort_arr,0,$orderField,$reverse);
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


//Returns Sessions id if given customer registered for session
function isCustomerRegistered($customer){
    return $this->db->select("Session_registration",array("Session_id"),array("Customer"=>$customer,
    "Session_id"=>$this->id,"Delected"=>'0'),1)['Session_id'] ;  
}


//Returns al registered sessions by given customer email
static function registeredSessions($email){
    $session_arr = array();
    foreach( self::$dbStatic->select("Session_Registration",array("Session_id"),
    array("Customer"=>$email,"Delected"=>'0')) as $row ) 
        $session_arr[] = self::getSessionData($row['Session_id']);
    return $session_arr;
}


//Returns all customers registered for the sesssion
function registeredCustomers(){
    $customer_arr = array();
    foreach( $this->db->select("Session_Registration",array("Customer"),
    array("Session_id"=>$this->id,"Delected"=>'0')) as $row ) 
        $customer_arr[] = $row['Customer'];
    return $customer_arr;
}


//Get the latest created session by logged in coach
//TODO
static function getLatestCreatedSession($coach){
    return self::$dbStatic->select("Session_details",array("Session_id"),array("Coach_Email"=>$coach),1,"Session_id",1)['Session_id'];
}


//Sets Customer observers for the session
function setCustomerObservers($notificationType){
    $coach_Registration = new Coach_Registration();
    if($notificationType===NOTIFICATION_SESSION_CREATE)
        foreach( $coach_Registration->registeredCustomers($this->getCreatedCoach()) as $row ) 
            $this->observers[] = new Customer($row['Customer']);
    elseif($notificationType===NOTIFICATION_SESSION_DELETE || $notificationType===NOTIFICATION_SESSION_EDIT)
        foreach( $this->registeredCustomers() as $customer ) 
            $this->observers[] = new Customer($customer);        
}


//Sets Coach observers for the session
function setCoachObservers($notificationType){ 
    $this->observers[] = new Coach($this->getCreatedCoach());
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
        'details'=>Notification::createNotificationDetails($type,$notification_data),'type'=>$type)); 
    }
   
}

}
?>