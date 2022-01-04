<?php


class Coach_Helper extends User_Helper{

function __construct(){
    parent::__construct("Coach");
}
    

//Returns details of the given coach_email
function getCoachData($coach_email){
    return $this->db->select("Coach",array("LastName", "FirstName", "Age", "Gender", "Telephone", "Email", 
    "City"),array("Email"=>$coach_email,"Delected"=>'0'),1);
}


//Returns all coach data
function getAllCoachData($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    return $this->db->select("Coach",$fields,$sort_arr,0,$orderField,$reverse);
}


//Returns all customer data
function getAllCoaches($sort_arr=0,$orderField=0,$reverse=0){
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    $coach_arr = array();
    foreach($this->db->select("Coach",array("Email"),$sort_arr,0,$orderField,$reverse) as $row){
        $coach_arr[] = $row['Email'];
    }
    return $coach_arr;
}




}




?>