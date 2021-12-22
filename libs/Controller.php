<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }

    public function loadModel($modelName){
        $path = 'models/'.$modelName.'_Model.php';
        if(file_exists($path)){
            require $path;
            $className = $modelName.'_Model';
            if($modelName==="Customer" || $modelName==="Coach" || $modelName==="Admin")
                $this->model = new $className(new MessageMediator());
            else
                $this->model = new $className();
        }
    }


}





?>