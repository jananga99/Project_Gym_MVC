<?php

class Coach extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Coach")
            $this->view->render('coach/Dash');
        else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();
        } 
    }

    function profile($action="view"){
        if($action==="view"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Coach"){
                $_SESSION['data'] = $this->model->getData($_SESSION['user']['email']);
                $this->view->render('coach/view/my');
            }else{
                header("Location:".BASE_DIR."Auth/login/Coach");
                die();
            }  
        }else if($action==="edit"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Coach"){
                $this->model->updateDetails($_SESSION['user']['email'],$_POST);
                header("Location:".BASE_DIR."coach/profile");
                die();
            }else{
                header("Location:".BASE_DIR."Auth/login/Coach");
                die();
            }             
        }
      
    }

}

?>