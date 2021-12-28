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
    }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
        $_SESSION['data'] = Customer::getCustomerData($_POST['select_customer_email']);
        $this->view->render('Customer/view/coach');        
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/view";
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }  
}


//Displaying registered coaches
function registeredCoaches(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
        $_SESSION['data'] = $this->model->getRegisteredCoachesData();
        $this->view->render('Coach_registration/registeredCoaches');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/registeredCoaches";
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }
}





}
