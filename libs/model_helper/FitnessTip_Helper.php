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


//Get the latest sent message
function getTipId($tip){
    return $this->db->select("fitness_tips",array("Tip_id"),array("Tip"=>$tip),1,"Tip_id",1)['Tip_id'];
}

}
?>