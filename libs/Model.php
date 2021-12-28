<?php

class Model{

    protected static $dbStatic;

    //Gets database object and creates the connection to database
    function __construct(){
        $this->db = Database::getInstance();
        $this->db->create(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    }

    //Sets database if a model is used as static
    static function setDatabase(){
        self::$dbStatic = Database::getInstance();
        self::$dbStatic->create(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    }



}





?>