<?php

require_once 'libs/model_helper/User_Helper.php';
class Customer_Helper extends User_Helper{

function __construct(){
    parent::__construct("Customer");
}
    

//Returns details of the given customer_email
function getCustomerData($customer_email){
    return $this->db->select("Customer",array("LastName", "FirstName", "Age", "Gender", "Telephone", "Email", 
    ),array("Email"=>$customer_email,"Delected"=>'0'),1);
}


//Returns all coach data
function getAllCustomerData($sort_arr=0,$orderField=0,$reverse=0){
    $fields = array("Email","FirstName","LastName","Gender");
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    return $this->db->select("Customer",$fields,$sort_arr,0,$orderField,$reverse);
}


//Returns all customer data
function getAllCustomers($sort_arr=0,$orderField=0,$reverse=0){
    if($sort_arr==0)
        $sort_arr = array();
    $sort_arr['Delected'] = 0;
    $customer_arr = array();
    foreach($this->db->select("Customer",array("Email"),$sort_arr,0,$orderField,$reverse) as $row){
        $customer_arr[] = $row['Email'];
    }
    return $customer_arr;
}





}




?>