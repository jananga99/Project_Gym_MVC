<?php

class View{

    function __construct(){
        
    }

    //require_onces view page
    public function render($viewName){
        require_once 'views/'.$viewName.'.php';
    }


}





?>