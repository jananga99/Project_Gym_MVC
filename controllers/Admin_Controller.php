<?php

class Admin_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Admin")
            $this->view->render('admin/Dash');
        else{
            header("Location:".BASE_DIR."Auth/login/Admin");
            die();
        } 
    }

    function profile($action="view"){
        if($action==="view"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Admin"){
                $_SESSION['data'] = $this->model->getData($_SESSION['user']['email']);
                $this->view->render('admin/view/my');
            }else{
                header("Location:".BASE_DIR."Auth/login/Admin");
                die();
            }  
        }else if($action==="edit"){
            if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Admin"){
                $this->model->updateDetails($_SESSION['user']['email'],$_POST);
                header("Location:".BASE_DIR."admin/profile");
                die();
            }else{
                header("Location:".BASE_DIR."Auth/login/Admin");
                die();
            }             
        }
      
    }

}

?>