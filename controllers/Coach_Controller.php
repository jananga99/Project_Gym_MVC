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
    if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
        $_SESSION['data'] = $this->model->getData();
        $this->view->render('Coach/view/my');
    }else{
        $_SESSION['requested_address'] = BASE_DIR."Coach/view";
        header("Location:".BASE_DIR."Auth/login/Coach");
        die();
    }  
}    
    
  

}

?>