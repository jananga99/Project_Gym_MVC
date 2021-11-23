<?php

class Model{

    function __construct(){
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
      //  $this->db=new mysqli(DB_HOST,DB_USER, DB_PASSWORD,DB_NAME);
    }



}





?>