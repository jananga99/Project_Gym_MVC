<?php

class Customer extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer")
            $this->view->render('Customer/Dash');
        else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();
        } 
    }

}








?>