<?php

class View{

    function __construct(){
        
    }

    //Requires view page
    public function render($viewName){
        require 'views/'.$viewName.'.php';
    }


}





?>