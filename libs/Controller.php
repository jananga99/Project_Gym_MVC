<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }

    public function loadModel($modelName){
        require 'models/Factory.php';
        $path = 'models/'.$modelName.'_Model.php';
        $factory = new Factory();
        $model = $factory->getModel($modelName);
        if($model)
            $this->model = $model;
    }


}





?>