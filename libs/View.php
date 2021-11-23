<?php

class View{

    function __construct(){
        
    }

    public function render($viewName,$data=0){
        require 'views/'.$viewName.'.php';
    }


}





?>