<?php

class Admin_Controller extends Controller{


function __construct(){
    parent::__construct();
}


function index(){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin")
        $this->view->render('admin/Dash');
    else{
        header("Location:".BASE_DIR."Auth/login");
        die();
    } 
}


//Displaying interface for signing up.
function viewCreate(){
    $this->view->render('Admin/auth/create');
}


//Creating/signing up Admins
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
            $this->factory->getModel("Admin",$data);  
            header("Location:".BASE_DIR.'Auth');
            die();
        }else{
            $_SESSION['msg'] = "This email is already registered.";   
        }   
    } 
    header("Location:".BASE_DIR."Admin/viewCreate");
    die();             
}

  
//Editing Admin details
function edit($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin" && $_SESSION['logged_user']['email']===$email){
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
            $this->model->edit(array("LastName"=>$_POST['lname'],"FirstName"=>$_POST['fname'],
            "Age"=>$_POST['age'],"Gender"=>$_POST['gender'],"City"=>$_POST['city'],"Telephone"=>$_POST['tel']),'ssdsss');
        }
        header("Location:".BASE_DIR."Admin/view/".$email);
        die();
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Admin/edit/".$email;
        header("Location:".BASE_DIR."Auth/login");
        die();
    }     
}
  

//Displaying Admin details
function view($email){
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin" && $_SESSION['logged_user']['email']===$email){
        $_SESSION['data'] = $this->model->getData();
        $this->view->render('Admin/view/my');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Admin/view/".$email;
        header("Location:".BASE_DIR."Auth/login");
        die();
    }  
}        

function view_reports(){
    $_SESSION['reports'] = $this->model->get_reports();
    $this->view->render("Admin/view/report");
}

function remove_report($email){
    $this->model->remove_report($email);
    $this->view_reports();
}


}

?>