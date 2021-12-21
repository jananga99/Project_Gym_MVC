<?php

class Customer extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer")
            $this->view->render('customer/Dash');
        else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();
        } 
    }

    function profile($action="view"){
        if($action==="view"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
                $_SESSION['data'] = $this->model->getData($_SESSION['user']['email']);
                $this->view->render('customer/view/my');
            }else{
                header("Location:".BASE_DIR."Auth/login/Customer");
                die();
            }  
        }else if($action==="edit"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
                $this->model->update($_SESSION['user']['email'],$_POST);
                header("Location:".BASE_DIR."customer/profile");
                die();
            }else{
                header("Location:".BASE_DIR."Auth/login/Customer");
                die();
            }             
        }
      
    }

    function coach($action){
        if($action==="search"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
                if(isset($_SESSION['flags'])){
                    $sort_arr=isset($_SESSION['flags']['sort_arr']) ? $_SESSION['flags']['sort_arr'] : 0;
                    $orderField=isset($_SESSION['flags']['orderField']) ? $_SESSION['flags']['orderField'] : 0;
                    $reverse=isset($_SESSION['flags']['reverse']) ? $_SESSION['flags']['reverse'] : 0;
                    $_SESSION['data'] =  $this->model->searchCoach($sort_arr,$orderField,$reverse);
                }
                $this->view->render('coach/view/searchAll');
            }
            else{
                header("Location:".BASE_DIR."Auth/login/Customer");
                die();
            }              
        }elseif($action==="select") {
            $temp = isset($_POST['select_email']) ? $_POST['select_email'] :  $_SESSION['data']['select_email'];
            $_SESSION['data'] = $this->model->viewCoach($temp);
            $_SESSION['data']['isRegistered'] = $this->model->isCoachRegistered($_SESSION['user']["email"],$temp);
            $_SESSION['data']['select_email'] = $temp;
            $this->view->render('coach/view/customer');
        }elseif ($action==="add") {
            $this->model->addCoach($_SESSION['user']['email'],$_SESSION['data']['register_coach']);
            header("Location:".BASE_DIR."Payment/success/coachRegister");
            die();              
        }elseif($action=="registered"){
            $_SESSION['data'] = $this->model->registeredCoaches($_SESSION['user']['email']);
            $this->view->render('customer/coach/registered');
        }
    }

}








?>