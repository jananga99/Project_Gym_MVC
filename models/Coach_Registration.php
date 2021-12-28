<?php

class Coach_Registration extends Model{

function __construct(){
    parent::__construct();
}


//Inserts given user details to database
function register($customer_email,$coach_email){
    $this->db->insert("coach_registration",array("Customer"=>$customer_email, "Coach"=>$coach_email),"ss");
}


//Deletes a registration (unregister)
function unregister($id){
    $this->db->update("coach_registration",array("Delected"=>'1'),array("Registration_id"=>$id),'d');    
}



//Returns True if given customer is registered for coach
function isCoachRegistered($customer,$coach){
    return $this->db->select("coach_registration",array("Registration_id"),array("Customer"=>$customer,"Coach"=>$coach,"Delected"=>0),
    1)['Registration_id'];  
}


//Returns the registered coaches for the given customer email
function registeredCoaches($email){
   return $this->db->select("coach_registration",array("Coach"),array("Customer"=>$email,"Delected"=>'0')) ;
}


//Returns the registered customers for the given coach email
function registeredCustomers($email){
    return $this->db->select("coach_registration",array("Customer"),array("Coach"=>$email,"Delected"=>'0')) ;
 }
 











}
?>