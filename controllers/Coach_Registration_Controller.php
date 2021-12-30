<?php

class Coach_Registration_Controller extends Controller{

function __construct(){
    parent::__construct();
}

function index(){
   
}


//Registering a Customer for a coach
function register(){
    $this->model->register($_SESSION['logged_user']['email'],$_POST['coach_email']);
    header("Location:".BASE_DIR."Coach/viewAll");
    //header("Location:".BASE_DIR."Payment/success/coachRegister");
    die();     
}


//UnRegistering a Customer from a coach
function unregister(){
    $this->model->unregister($_POST['Registration_id']);
    header("Location:".BASE_DIR."Coach/viewAll");
    die();     
}





}

?>