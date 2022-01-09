<?php
class Report extends Model{

    function __construct(){
        parent::__construct();
    }
    
    function submit_report($reason,$email){
        $this->db->insert("report",array("Reason"=>$reason,"Email"=>$email),"ss");
    }

}
?>