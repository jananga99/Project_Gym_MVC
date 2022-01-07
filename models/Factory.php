<?php

class Factory{

    //Creates model objects checking conditions
    function getModel($modelName,$data){
        
        $path = 'models/'.$modelName.'.php';    
        $model=0;
        if(file_exists($path)){
                if(  (isset($data['id']) && !(is_null($data['id'])) )  || isset($data['create_data'])){
                    require_once $path;
                    $model = new $modelName($data);
                }
        }       
        return $model;
    }

}


?>