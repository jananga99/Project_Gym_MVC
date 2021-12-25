<?php

class Admin_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin")
            $this->view->render('admin/Dash');
        else{
            header("Location:".BASE_DIR."Auth/login/Admin");
            die();
        } 
    }

    //Renders Admin creating page
    function create($submitted=0){
        $this->view->render('Admin/auth/create');
    } 

    function profile($action="view"){
        if($action==="view"){
            if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){
                $_SESSION['data'] = $this->model->getData($_SESSION['logged_user']['email']);
                $this->view->render('admin/view/my');
            }else{
                header("Location:".BASE_DIR."Auth/login/Admin");
                die();
            }  
        }else if($action==="edit"){
            if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){
                $this->model->updateDetails($_SESSION['logged_user']['email'],$_POST);
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