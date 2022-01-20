<?php

class Coach_Controller extends Controller{

function __construct(){
    parent::__construct();
}


function index(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach")
        $this->view->render('coach/Dash');
       
    else{
        header("Location:".BASE_DIR."Auth/login");
        die();
    } 
}


//Displaying interface for signing up.
function viewCreate(){
    $this->view->render('Coach/auth/create');
}


//Creating/signing up Coaches
function create($submitted=0){
    if(!$this->validator->validateName($_POST['lname'])){
        $_SESSION['msg'] = "Last name is not valid";
    }elseif(!$this->validator->validateName($_POST['fname'])){
        $_SESSION['msg'] = "First name is not valid";
    }elseif(!$this->validator->validateAge($_POST['age'])){
        $_SESSION['msg'] = "Age is not valid";
    }elseif(!$this->validator->validateGender($_POST['gender'])){
        $_SESSION['msg'] = "Gender is not valid";
    }elseif(!$this->validator->validateTelNum($_POST['tel'])){
        $_SESSION['msg'] = "Telephone number is not valid";
    }elseif(!$this->validator->validateEmail($_POST['email'])){
        $_SESSION['msg'] = "Email is not valid";
    }elseif(!$this->validator->validateCity($_POST['city'])){
        $_SESSION['msg'] = "City is not valid";    
    }else{
        $success = $this->model->isEmailUnique($_POST['email']);
        if($success){
            $data = array();
            $data['create_data'] = array("LastName"=>$_POST['lname'], "FirstName"=>$_POST['fname'], "Age"=>$_POST['age'], 
            "Gender"=>$_POST['gender'],"City"=>$_POST['city'], "Telephone"=>$_POST['tel'], "email"=>$_POST['email'], 
            "password"=>sha1($_POST['password']));
            $data['create_data_types'] = "ssdsssss";
            $this->factory->getModel("Coach",$data);  
            header("Location:".BASE_DIR.'Auth');
            die();    
        }else{
            $_SESSION['msg'] = "This email is already registered.";   
        }  
    }
    header("Location:".BASE_DIR."Coach/viewCreate");
    die();                 
}   


// Editing Coach details
function edit($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" && $_SESSION['logged_user']['email']===$email){
        if(!$this->validator->validateName($_POST['lname'])){
            $_SESSION['msg'] = "Last name is not valid";
        }elseif(!$this->validator->validateName($_POST['fname'])){
            $_SESSION['msg'] = "First name is not valid";
        }elseif(!$this->validator->validateAge($_POST['age'])){
            $_SESSION['msg'] = "Age is not valid";
        }elseif(!$this->validator->validateGender($_POST['gender'])){
            $_SESSION['msg'] = "Gender is not valid";
        }elseif(!$this->validator->validateTelNum($_POST['tel'])){
            $_SESSION['msg'] = "Telephone number is not valid";
        }elseif(!$this->validator->validateCity($_POST['city'])){
            $_SESSION['msg'] = "City is not valid";    
        }else{        
            $this->model->edit(array("LastName"=>$_POST['lname'],"FirstName"=>$_POST['fname'],"Age"=>$_POST['age'], 
            "City"=>$_POST['city'],"Gender"=>$_POST['gender'],"Telephone"=>$_POST['tel']),'ssdsss');
        }
        header("Location:".BASE_DIR."Coach/view/".$email);
        die();      
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach/edit/".$email;
        header("Location:".BASE_DIR."Auth/login");
        die();
    }     
}


//Displaying coach details
function view($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" && $_SESSION['logged_user']['email']===$email){     //For himself
        $_SESSION['data'] = $this->model->getData();
        $this->view->render('Coach/view/my');
    }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){    //For a customer
        $_SESSION['data'] = $this->model->getCoachData($email);
        $_SESSION['data']['registration_price'] = $this->model->getRegistrationPrice();
        $_SESSION['data']['isRegistered'] = $this->model->isCoachRegisteredForCustomer($_SESSION['logged_user']['email'],$email);
        $this->view->render('Coach/view/customer');
    }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){    //For an admin
        $_SESSION['data'] = $this->model->getCoachData($email);
        $this->view->render('Coach/view/admin');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach/view/".$email;
        header("Location:".BASE_DIR."Auth/login");
        die();
    }  
}    
    

//Displaying all coaches accordign to sorting options
function viewAll(){
    $sort_arr=isset($_POST["by"]) && isset($_POST["sort_by_gender"]) ? array("gender"=>$_POST["sort_radio_gender"]) : 0;
    $orderField=isset($_POST["by"]) && isset($_POST["order_by"])  && $_POST["order_by"] != "none" ? "CONCAT(FirstName,LastName)" : 0;
    $reverse=isset($_POST["by"]) && isset($_POST['order_radio_name']) && $_POST['order_radio_name'] == 'z_to_a' ? 1 : 0;
    $_SESSION['data'] =  $this->model->getAllCoachData($sort_arr,$orderField,$reverse);
    $this->view->render('coach/view/all');
}


//Displaying registered customers
function registeredCustomers($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
        $_SESSION['data'] = $this->model->getRegisteredCustomersData($email);
        $this->view->render('Coach_registration/registeredCustomers');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/registeredCustomers";
        header("Location:".BASE_DIR."Auth/login");
        die();
    }
}



}

?>