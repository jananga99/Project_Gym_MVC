<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }

    //Loads the Model using Factroy object
    public function loadModel($modelName){
        require_once 'models/Factory.php';
        $path = 'models/'.$modelName.'.php';
        $factory = new Factory();
        $model = $factory->getModel($modelName);
        if($model)
            $this->model = $model;
    }


}





?>