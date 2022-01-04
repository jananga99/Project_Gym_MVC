<?php

class FitnessTip extends Model{

function __construct($id){
    parent::__construct();
    $this->id = $id;
}


//Returns all fitness tips
static function getAllFitnessTips($sort_arr=0){
    $fields = array("Tip");
    return $this->db->select("Fitness_tips",$fields,$sort_arr);
}


//Creates the fitness tip
static function create($data){
    $this->db->insert("Fitness_Tips",$data,"ss");
}


}
?>