<?php

class Factory{

    function getModel($modelName){
        $path = 'models/'.$modelName.'_Model.php';
        if(file_exists($path)){
            require $path;
            $className = $modelName.'_Model';
           // if($modelName==="Customer" || $modelName==="Coach" || $modelName==="Admin")
           //     $this->model = new $className(new MessageMediator());
          //  else
                return new $className();
        }        
        return 0;
    }



}


?>