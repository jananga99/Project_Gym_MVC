<?php

class FitnessTip extends Model{

function __construct($data=-1){
    parent::__construct();
    if($data!=-1){
        if(isset($data['id']) && !(is_null($data['id'])) ){
            $this->id=$data['id'];
        }else{
            $this->create($data['create_data']);
            $this->id =  $this->helper_factory->getHelper("FitnessTip")->getTipId($data['create_data']['Tip']);   
        }
    }
}


//Creates the fitness tip
function create($data){
    $this->db->insert("Fitness_Tips",$data,"ss");
}



///////////////Helper Fucntions//////////////

//Returns all fitness tips
function getAllFitnessTips($sort_arr=0){
    return $this->helper_factory->getHelper("FitnessTip")->getAllFitnessTips($sort_arr); 
}


//Get the latest sent message
function getTipId($tip){
    return $this->helper_factory->getHelper("FitnessTip")->getTipId($tip);
}




}
?>