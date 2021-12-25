<?php

class Factory extends Model{

    private static $instance;

    private function __construct(){
        parent::__construct();
    }

    //Singleton is applied for factory
    private function getInstance(){
        if(self::$instance==NULL)
            self::$instance = new Factory();
        return self::$instance;
    }

    //Creates model objects checking conditions
    static function getModel($modelName){
        if($modelName==="Factory")
            return self::getInstance();
        $path = 'models/'.$modelName.'.php';
        if(file_exists($path)){
            require $path;
            return new $modelName();
        }        
        return 0;
    }

    //Returns true if email is unique from all previous users, false otherwise
    function isEmailunique($email){
        foreach(array("Customer","Coach","Admin") as $type){
            if($this->db->select($type,array("Email"),array("Email"=>$email),1,0,0,"s"))
                return FALSE;
        }
        return TRUE;        
    }

    function addCustomerToDatabase($arr){
        $this->db->insert("Customer",array("LastName"=>$arr['lname'], "FirstName"=>$arr['fname'], "Age"=>$arr['age'], "Gender"=>$arr['gender'], "Telephone"=>$arr['tel'], "email"=>$arr['email'], "password"=>sha1($arr['password'])),"ssdssss");
    }

    function addCoachToDatabase($arr){
        $this->db->insert("Coach",array("LastName"=>$arr['lname'], "FirstName"=>$arr['fname'], "Age"=>$arr['age'], "Gender"=>$arr['gender'],"City"=>$arr['city'], "Telephone"=>$arr['tel'], "email"=>$arr['email'], "password"=>sha1($arr['password'])),"ssdsssss");
    }

    function addAdminToDatabase($arr){
        $this->db->insert("Admin",array("LastName"=>$arr['lname'], "FirstName"=>$arr['fname'], "Age"=>$arr['age'], "Gender"=>$arr['gender'],"City"=>$arr['city'], "Telephone"=>$arr['tel'], "email"=>$arr['email'], "password"=>sha1($arr['password'])),"ssdsssss");
    }


}


?>