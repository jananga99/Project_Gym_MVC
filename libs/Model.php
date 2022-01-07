<?php

class Model{

    //Gets database object and creates the connection to database
    function __construct(){
        $this->db = Database::getInstance();
        $this->db->create(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
        $this->factory = new Factory();
        $this->helper_factory = new Helper_Factory();
    }


}





?>