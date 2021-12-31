<?php

class Coach_Registration_Controller extends Controller{

function __construct(){
    parent::__construct();
}

function index(){
   
}


//Registering a Customer for a coach
function register($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
        $this->model->register($_SESSION['logged_user']['email'],$email);
        header("Location:".BASE_DIR."Coach/viewAll");
        //header("Location:".BASE_DIR."Payment/success/coachRegister");
        die();   
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach_Registration/register/".$email;
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }
}


//UnRegistering a Customer from a coach
function unregister($id){ 
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){    
        $this->model->unregister($id);
        header("Location:".BASE_DIR."Coach/viewAll");
        die();   
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach_Registration/unregister/".$id;
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }  
}





}

?>