<?php

class Customer_Controller extends Controller{


function __construct(){
    parent::__construct();
}


function index(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer")
        $this->view->render('customer/Dash');
    else{
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    } 
}


//Creating/signing up Customers
function create($submitted=0){
    if($submitted){
        //Do validations TODO
        $success = $this->model->isEmailUnique($_POST['email']);
        if($success){
            $this->model->createUser("Customer",array("LastName"=>$_POST['lname'], "FirstName"=>$_POST['fname'], "Age"=>$_POST['age'], 
            "Gender"=>$_POST['gender'], "Telephone"=>$_POST['tel'], "email"=>$_POST['email'], "password"=>sha1($_POST['password'])),
            "ssdssss");
            header("Location:".BASE_DIR.'Auth');
            die();    
        }else{
            $_SESSION['msg'] = "This email is already registered.";
            header("Location:".BASE_DIR."Customer/create");
            die();    
        }                 
    }
    else{
        $this->view->render('Customer/auth/create');
        
    } 
}
  

// Editing Customer details
function edit(){
    //Do validations TODO
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
        $this->model->edit(array("LastName"=>$_POST['lname'],"FirstName"=>$_POST['fname'],
        "Age"=>$_POST['age'],"Gender"=>$_POST['gender'],"Telephone"=>$_POST['tel']),'ssdss');
        header("Location:".BASE_DIR."Customer/view");
        die();
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/edit";
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }     
}


//Displaying customer details
function view(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
        $_SESSION['data'] = $this->model->getData();
        $this->view->render('Customer/view/my');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/view";
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }  
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function coach($action){
    if($action==="search"){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
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
        $_SESSION['data']['isRegistered'] = $this->model->isCoachRegistered($_SESSION['logged_user']["email"],$temp);
        $_SESSION['data']['select_email'] = $temp;
        $this->view->render('coach/view/customer');
    }elseif ($action==="add") {
        $this->model->addCoach($_SESSION['logged_user']['email'],$_SESSION['data']['register_coach']);
        header("Location:".BASE_DIR."Payment/success/coachRegister");
        die();              
    }elseif($action=="registered"){
        $_SESSION['data'] = $this->model->registeredCoaches($_SESSION['logged_user']['email']);
        $this->view->render('customer/coach/registered');
    }
}


}
