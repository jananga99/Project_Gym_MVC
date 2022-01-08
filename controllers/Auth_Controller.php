<?php

class Auth_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        header("Location:".BASE_DIR.'Auth/login');
        die();
    }

    //Renders login page
    function login(){
        $this->view->render('Auth/login');
    }

    //Redirects to dashboard if login credentials are valid
    function checklogin(){
        $type=$this->model->validateLogIn($_POST['email'],$_POST["password"]);
        if($type){
            $_SESSION['logged_user'] = array("email"=>$_POST['email'],"type"=>$type);
            if(isset($_SESSION['requested_address'])){
                $requested_address = $_SESSION['requested_address'];
                unset($_SESSION['requested_address']); 
                header("Location:".$requested_address);
            }else
                header("Location:".BASE_DIR.$type);
            die();
        }else{
            $_SESSION['msg'] = "Wrong Username or password";
            header("Location:".BASE_DIR.'Auth/login');
            die();            
        }
    }

    //logging out the current user by resetting logged_user
    function logout(){
        unset( $_SESSION['logged_user']);
        unset($_SESSION['requested_address']);
        unset($_SESSION['payment_data']);
        unset($_SESSION['data']);
        unset($_SESSION['payment_request_data']); 
        header("Location:".BASE_DIR);
        die();
    }

}








?>