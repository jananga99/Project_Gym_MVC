<?php

class Coach_Registration extends Model{

function __construct($id){
    $this->id = $id;
    parent::__construct();
}

//Deletes a registration (unregister)
function unregister(){
    $this->db->update("coach_registration",array("Delected"=>'1'),array("Registration_id"=>$this->id),'d');    
}


}
?>