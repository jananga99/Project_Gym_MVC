<?php

class FitnessTip extends Model{

function __construct($data){
    parent::__construct();
    if(isset($data['id']) && !(is_null($data['id'])) ){
        $this->id=$data['id'];
    }else{
        $this->create($data['create_data']);
        $this->id =  $this->helper_factory->getHelper("FitnessTip")->getTipId($data['create_data']['Tip']);   
    }
}


//Creates the fitness tip
function create($data){
    $this->db->insert("Fitness_Tips",$data,"ss");
}


}
?>