<?php
require 'ObjectPool.php';
class DBConnectionPool extends ObjectPool{
    private $host,$user,$password,$db;
    function __construct($host,$user,$password,$db){
        parent::__construct();
        $this->host=$host;
        $this->user=$user;
        $this->password=$password;
        $this->db=$db;
    }

    protected function create(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
          $mysqli = new mysqli($this->host,$this->user,$this->password,$this->db);
          $mysqli->set_charset("utf8mb4");
          return $mysqli;
        } catch(Exception $e) {
          error_log($e->getMessage());
          exit('Error connecting to database'); //Should be a message a typical user could understand
        }        
    }
    
    function validate($o){
        if($o -> connect_errno)
            exit('Error validating to database connection'); //Should be a message a typical user could understand
        else
            return true;
    }

    function expire($o){
        $o->close();
    }

}


?>