<?php

class Factory_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        header("Location:".BASE_DIR.'Auth/login');
        die();
    }

    function customer(){
        //Do validations TODO
        $success = $this->model->isEmailUnique($_POST['email']);
        if($success){
            $this->model->addCustomerToDatabase($_POST);
            header("Location:".BASE_DIR.'Auth');
            die();    
        }else{
            $_SESSION['msg'] = "This email is already registered.";
            header("Location:".BASE_DIR."Customer/create");
            die();    
        }     
    }

    function coach(){
        //Do validations TODO
        $success = $this->model->isEmailUnique($_POST['email']);
        if($success){
            $this->model->addCoachToDatabase($_POST);
            header("Location:".BASE_DIR.'Auth');
            die();  
        }else{
            $_SESSION['msg'] = "This email is already registered.";
            header("Location:".BASE_DIR."Coach/create");
            die();    
        }              
    }

    function admin(){
        //Do validations TODO
        $success = $this->model->isEmailUnique($_POST['email']);
        if($success){
            $this->model->addAdminToDatabase($_POST);
            header("Location:".BASE_DIR.'Auth');
            die();  
        }else{
            $_SESSION['msg'] = "This email is already registered.";
            header("Location:".BASE_DIR."Admin/create");
            die();    
        }               
    }


   
}








?>