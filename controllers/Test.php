<?php

class Test extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->view->render('Test');
        $this->model->getData();
    }

}








?>