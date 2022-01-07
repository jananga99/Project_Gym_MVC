<?php

class Coach_Registration extends Model{

function __construct($data){
    parent::__construct();
    if(!is_null($data['id'])){
        $this->id=$data['id'];
    }else{
        $this->register($data['create_data']['customer_email'],$data['create_data']['coach_email']);
        $this->id =  $this->helper_factory->getHelper("Coach_Registration")->getRegistrationId($data['create_data']['customer_email'],$data['create_data']['coach_email']);   
    }
}


//Inserts given user details to database
function register($customer_email,$coach_email){
    $this->db->insert("coach_registration",array("Customer"=>$customer_email, "Coach"=>$coach_email),"ss");
}


//Deletes a registration (unregister)
function unregister(){
    $this->db->update("coach_registration",array("Delected"=>'1'),array("Registration_id"=>$this->id),'d');    
}


}
?>