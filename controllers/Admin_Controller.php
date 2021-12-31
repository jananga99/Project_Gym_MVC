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


//Displaying interface for signing up.
function viewCreate(){
    $this->view->render('Admin/auth/create');
}


//Creating/signing up Admins
function create($submitted=0){
    //Do validations TODO
    $success = Admin::isEmailUnique($_POST['email']);
    if($success){
        Admin::create("Admin",array("LastName"=>$_POST['lname'], "FirstName"=>$_POST['fname'], "Age"=>$_POST['age'], 
        "Gender"=>$_POST['gender'],"City"=>$_POST['city'], "Telephone"=>$_POST['tel'], "email"=>$_POST['email'], 
        "password"=>sha1($_POST['password'])),"ssdsssss");
        header("Location:".BASE_DIR.'Auth');
        die();    
    }else{
        $_SESSION['msg'] = "This email is already registered.";
        header("Location:".BASE_DIR."Admin/create");
        die();    
    }                 
}

  
//Editing Admin details
function edit($email){
    //Do validations TODO
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin" && $_SESSION['logged_user']['type']===$email){
        $this->model->edit(array("LastName"=>$_POST['lname'],"FirstName"=>$_POST['fname'],
        "Age"=>$_POST['age'],"Gender"=>$_POST['gender'],"City"=>$_POST['city'],"Telephone"=>$_POST['tel']),'ssdsss');
        header("Location:".BASE_DIR."Admin/view/".$email);
        die();
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Admin/edit/".$email;
        header("Location:".BASE_DIR."Auth/login/Admin");
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
        header("Location:".BASE_DIR."Auth/login/Admin");
        die();
    }  
}        



}

?>