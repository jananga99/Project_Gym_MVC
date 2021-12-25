<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }

    //Loads the Model using Factroy object
    public function loadModel($modelName){
        require 'models/Factory.php';
        $path = 'models/'.$modelName.'.php';
        $model = Factory::getModel($modelName);
        if($model)
            $this->model = $model;
    }


}





?>