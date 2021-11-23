<?php

class Coach extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->view->render('Coach/Dash');
    }

}

?>