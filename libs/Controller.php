<?php

class Controller{

    function __construct(){
        $this->view = new View();
        $this->validator = new Validator();
    }

    //Loads the Model using Factroy object
    public function loadModel($modelName){
        require_once 'models/Factory.php';
        $path = 'models/'.$modelName.'.php';
        $this->factory = new Factory();
        $model = $this->factory->getModel($modelName,array('id'=>$this->_getFirstParametre()));
        if($model)
            $this->model = $model;
    }


    //returns the function part of the url
    private function _getFirstParametre(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;  
        $url = rtrim($url, '/'); 
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/',$url);
        if(isset($url[2]))
            return $url[2];
        return NULL; 
    }   

}





?>