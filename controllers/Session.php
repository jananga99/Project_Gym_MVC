<?php

class Session extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
            header("Location:".BASE_DIR."Session/search");
            die(); 
        }else{
            header("Location:".BASE_DIR);
            die();
        }
    }

    function search(){
        $_SESSION['data'] =  $this->model->search();
        $this->view->render('session/searchAll');        
    }

    function select(){
        $temp = isset($_POST['select_session']) ? $_POST['select_session'] :  $_SESSION['data']['select_session'];
        $_SESSION['data'] = $this->model->view($temp);
        $_SESSION['data']['isRegistered'] = $this->model->isSessionRegistered($_SESSION['user']["email"],$temp);
        $_SESSION['data']['select_session'] = $temp;
        $this->view->render('session/view/customer');        
    }

    function register(){
        $this->model->register($_SESSION['user']['email'],$_POST['select_session']);
        header("Location:".BASE_DIR."Session/select");
        die();        
    }

    function registered(){
        $_SESSION['data'] = $this->model->registeredSessions($_SESSION['user']['email']);
        $this->view->render('session/registered');
    }
    

    function create(){
        $this->view->render('session/create');
    }

    function add(){
        $this->model->add($_SESSION['user']['email'],$_SESSION['data']);
        header("Location:".BASE_DIR."Session/create");
        die(); 
    }

    function coach($action){
        if($action==="search"){
                     
        }elseif($action==="select") {
    
        }elseif ($action==="add") {
            $this->model->addCoach($_SESSION['user']['email'],$_SESSION['data']['select_email']);
            header("Location:".BASE_DIR."Customer/coach/select");
            die();            
        }elseif($action=="registered"){

        }
    }

}








?>