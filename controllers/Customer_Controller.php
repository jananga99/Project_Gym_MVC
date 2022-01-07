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


//Displaying interface for signing up.
function viewCreate(){
    $this->view->render('Customer/auth/create');
}


//Creating/signing up Customers
function create(){
    //Do validations TODO
    $customer_helper = new Customer_Helper();
    $success = $customer_helper->isEmailUnique($_POST['email']);
    if($success){
        $customer_helper->create("Customer",array("LastName"=>$_POST['lname'], "FirstName"=>$_POST['fname'], "Age"=>$_POST['age'], 
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
  

// Editing Customer details
function edit($email){
    //Do validations TODO
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer" && $_SESSION['logged_user']['email']===$email){
        $this->model->edit(array("LastName"=>$_POST['lname'],"FirstName"=>$_POST['fname'],
        "Age"=>$_POST['age'],"Gender"=>$_POST['gender'],"Telephone"=>$_POST['tel']),'ssdss');
        header("Location:".BASE_DIR."Customer/view/".$email);
        die();
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/edit/".$email;
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }     
}


//Displaying customer details
function view($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer" 
    && $_SESSION['logged_user']['email']===$email){
        $_SESSION['data'] = $this->model->getData();
        $this->view->render('Customer/view/my');
    }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
        $customer_helper = new Customer_Helper();
        $_SESSION['data'] = $customer_helper->getCustomerData($email);
        $this->view->render('Customer/view/coach');        
    }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){
        $customer_helper = new Customer_Helper();
        $_SESSION['data'] = $customer_helper->getCustomerData($email);
        $this->view->render('Customer/view/admin');            
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/view/".$email;
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }  
}


//Displaying All Customers
function viewAll(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){
        $sort_arr=isset($_POST["by"]) && isset($_POST["sort_by_gender"]) ? array("gender"=>$_POST["sort_radio_gender"]) : 0;
        $orderField=isset($_POST["by"]) && isset($_POST["order_by"])  && $_POST["order_by"] != "none" ? "CONCAT(FirstName,LastName)" : 0;
        $reverse=isset($_POST["by"]) && isset($_POST['order_radio_name']) && $_POST['order_radio_name'] == 'z_to_a' ? 1 : 0;        
        $customer_helper = new Customer_Helper();
        $_SESSION['data'] = $customer_helper->getAllCustomerData($sort_arr,$orderField,$reverse);
        $this->view->render('Customer/view/all');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/viewAll";
        header("Location:".BASE_DIR);
        die();
    }  
}


//Displaying registered coaches
function registeredCoaches($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
        $factory = new Factory();
        $cr =  new Coach_Registration_Helper();
        $_SESSION['data'] = $cr->getRegisteredCoachesData($email);
        $this->view->render('Coach_registration/registeredCoaches');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/registeredCoaches";
        header("Location:".BASE_DIR."Auth/login/Customer");
        die();
    }
}





}
