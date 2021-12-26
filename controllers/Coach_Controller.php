<?php

class Coach_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach")
            $this->view->render('coach/Dash');
        else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();
        } 
    }

    //Creating/signing up Coaches
    function create($submitted=0){
        if($submitted){
            //Do validations TODO
            $success = $this->model->isEmailUnique($_POST['email']);
            if($success){
                $this->model->createUser("Coach",array("LastName"=>$_POST['lname'], "FirstName"=>$_POST['fname'], "Age"=>$_POST['age'], 
                "Gender"=>$_POST['gender'],"City"=>$_POST['city'], "Telephone"=>$_POST['tel'], "email"=>$_POST['email'],
                 "password"=>sha1($_POST['password'])),"ssdsssss");
                header("Location:".BASE_DIR.'Auth');
                die();    
            }else{
                $_SESSION['msg'] = "This email is already registered.";
                header("Location:".BASE_DIR."Coach/create");
                die();    
            }                 
        }
        else{
            $this->view->render('Coach/auth/create');
            
        } 
    }   

    function profile($action="view"){
        if($action==="view"){
            if(isset($_SESSION['logged_user']) && isset($_SESSION['logged_user']['type'])){
                if($_SESSION['logged_user']['type']==="Coach"){
                    $_SESSION['data'] = $this->model->getData($_SESSION['logged_user']['email']);
                    $this->view->render('coach/view/my');    
                }else{
                    $_SESSION['data'] = $this->model->getData($_POST['coach_email']);
                    $_SESSION['data']['isRegistered'] = 1;
                    $this->view->render('coach/view/customer');    
                }
            }else{
                header("Location:".BASE_DIR."Auth/login/Coach");
                die();
            }  
        }else if($action==="edit"){
            if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
                $this->model->updateDetails($_SESSION['logged_user']['email'],$_POST);
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