<?php

class Auth_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        header("Location:".BASE_DIR.'Auth/login');
        die();
    }

    function login(){
        $this->view->render('Auth/login');
    }

    //Redirects to dashboard if login credentials are valid
    function checklogin(){
        $type=$this->model->validateLogIn($_POST['email'],$_POST["password"]);
        if($type){
            $_SESSION['logged_user'] = array("email"=>$_POST['email'],"type"=>$type);
            header("Location:".BASE_DIR.$type);
            die();
        }else{
            $_SESSION['msg'] = "Wrong Username or password";
            header("Location:".BASE_DIR.'Auth/login');
            die();            
        }
    }

    function logout(){
        unset( $_SESSION['user']);
        header("Location:".BASE_DIR);
        die();
    }

    function signup($type="Customer"){
        $this->view->render($type.'/signup',array("type"=>$type));
    }

    function addsignup($type){
        if($this->model->validateSignup($_POST['email'])){
            $this->model->signup($type,$_POST);
            header("Location:".BASE_DIR.'Auth/login/'.$type);
            die(); 
        }else{
            $_SESSION['msg'] = "This email is already registered.";
            header("Location:".BASE_DIR.'Auth/signup/'.$type);
            die();                 
        }
       
    }

}








?>