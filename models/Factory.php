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
            
            if(!(self::_getFunction()==="create")){
                require $path;
                return new $modelName();
            }else{
                require 'models/User123.php';
                return new User123();
            }
                
        }       
        return 0;
    }

    //returns the function part of the url
    private static function _getFunction(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;  
        $url = rtrim($url, '/'); 
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/',$url);
        if(isset($url[1]))
            return $url[1];
        return NULL; 
    }

}


?>