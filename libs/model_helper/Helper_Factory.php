<?php

class Helper_Factory{

    //Creates helper objects 
    function getHelper($helperName){
        
        $path = 'libs/model_helper/'.$helperName.'_Helper.php';    
        $helper=0;
        if(file_exists($path)){
            require_once $path;
            $fileName = $helperName.'_Helper';
            $helper = new $fileName();
        }       
        return $helper;
    }

}


?>