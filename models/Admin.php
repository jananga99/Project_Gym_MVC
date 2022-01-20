<?php
require_once 'models/User.php';
class Admin extends User{

function __construct($data=-1){
    parent::__construct("Admin",$data);
}

function get_reports(){
    return $this->db->select("report");
}

function ignore_report($email){
     $this->db->update("report",array("Deleted"=>1),array("Email"=>$email),"d");
}

function ban_coach($email){
    $this->db->update("coach",array("Suspended"=>1),array("Email"=>$email),"d");
}














}
?>