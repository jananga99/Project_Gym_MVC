<?php

class FitnessTip_Helper extends Helper{

function __construct(){
    parent::__construct();
}

//Returns all fitness tips
function getAllFitnessTips($sort_arr=0){
    $fields = array("Tip");
    return $this->db->select("Fitness_tips",$fields,$sort_arr);
}


//Creates the fitness tip
function create($data){
    $this->db->insert("Fitness_Tips",$data,"ss");
}


}
?>