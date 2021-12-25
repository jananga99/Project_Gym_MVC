<?php

class Factory{

    private $instance;

    private function __construct(){}

    //Singleton is applied for factory
    private function getInstance(){
        if($this->instance==NULL)
            $this->instance = new Factory();
        return $this->instance;
    }

    //Creates model objects checking conditions
    static function getModel($modelName){
        if($modelName==="Factory")
            return $this->getInstance();
        $path = 'models/'.$modelName.'.php';
        if(file_exists($path)){
            require $path;
            return new $modelName();
        }        
        return 0;
    }



}


?>