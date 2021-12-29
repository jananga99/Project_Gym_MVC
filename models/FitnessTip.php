<?php

class FitnessTip extends Model{

function __construct($id){
    parent::__construct();
    $this->id = $id;
}


//Returns all fitness tips
static function getAllFitnessTips($sort_arr=0){
    $fields = array("Tip");
    return self::$dbStatic->select("Fitness_tips",$fields,$sort_arr);
}


//Creates the fitness tip
static function create($data){
    self::$dbStatic->insert("Fitness_Tips",$data,"ss");
}


}
?>