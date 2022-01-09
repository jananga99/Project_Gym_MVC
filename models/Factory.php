<?php

class Factory{

    //Creates model objects checking conditions
    function getModel($modelName,$data){
        
        $path = 'models/'.$modelName.'.php';    
        $model=0;
        if(file_exists($path)){
            require_once $path;
            if(  (isset($data['id']) && !(is_null($data['id'])) )  || isset($data['create_data']))   
                $model = new $modelName($data);
            else
                $model = new $modelName();
        }       
        return $model;
    }

}


?>