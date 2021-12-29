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


//Displaying interface for signing up.
function viewCreate(){
    $this->view->render('Coach/auth/create');
}


//Creating/signing up Coaches
function create($submitted=0){
      //Do validations TODO
    $success = Coach::isEmailUnique($_POST['email']);
    if($success){
        Coach::create("Coach",array("LastName"=>$_POST['lname'], "FirstName"=>$_POST['fname'], "Age"=>$_POST['age'], 
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


// Editing Coach details
function edit(){
    //Do validations TODO
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
        $this->model->edit(array("LastName"=>$_POST['lname'],"FirstName"=>$_POST['fname'],"Age"=>$_POST['age'], 
        "City"=>$_POST['city'],"Gender"=>$_POST['gender'],"Telephone"=>$_POST['tel']),'ssdsss');
        header("Location:".BASE_DIR."Coach/view");
        die();
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach/edit";
        header("Location:".BASE_DIR."Auth/login/Coach");
        die();
    }     
}


//Displaying coach details
function view(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){     //For himself
        $_SESSION['data'] = $this->model->getData();
        $this->view->render('Coach/view/my');
    }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){    //For a customer
        $_SESSION['data'] = Coach::getCoachData($_POST['select_coach_email']);
        $coach_registration = new Coach_Registration();
        $_SESSION['data']['isRegistered'] = $coach_registration->isCoachRegistered($_SESSION['logged_user']['email'],
            $_POST['select_coach_email']);
        $this->view->render('Coach/view/customer');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach/view";
        header("Location:".BASE_DIR."Auth/login/Coach");
        die();
    }  
}    
    

//Displaying all coaches accordign to sorting options
function viewAll(){
    $sort_arr=isset($_POST["by"]) && isset($_POST["sort_by_gender"]) ? array("gender"=>$_POST["sort_radio_gender"]) : 0;
    $orderField=isset($_POST["by"]) && isset($_POST["order_by"])  && $_POST["order_by"] != "none" ? "CONCAT(FirstName,LastName)" : 0;
    $reverse=isset($_POST["by"]) && isset($_POST['order_radio_name']) && $_POST['order_radio_name'] == 'z_to_a' ? 1 : 0;
    $_SESSION['data'] =  Coach::getAllCoachData($sort_arr,$orderField,$reverse);
    $this->view->render('coach/view/all');
}


//Displaying registered customers
function registeredCustomers(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
        $_SESSION['data'] = $this->model->getRegisteredCustomersData();
        $this->view->render('Coach_registration/registeredCustomers');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Customer/registeredCustomers";
        header("Location:".BASE_DIR."Auth/login/Coach");
        die();
    }
}



}

?>