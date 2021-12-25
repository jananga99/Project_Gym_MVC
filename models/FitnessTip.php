<?php

class FitnessTip extends Model{

function __construct(){
    parent::__construct();
}

function search($sort_arr=0){
    $fields = array("Tip");
    return $this->db->select("Fitness_tips",$fields,$sort_arr);
}

function add($data){
    $this->db->insert("Fitness_Tips",array("Tip"=>$data['tip'],"for_which_gender"=>$data['gender']),"ss");
}

}
?>