<?php

class Session extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
            header("Location:".BASE_DIR."Session/customer/search");
            die(); 
        }else{
            header("Location:".BASE_DIR);
            die();
        }
    }

    //Renders registered sessions by a customer
    function registered(){
        if($_SESSION['user']['type']==="Customer"){
            $_SESSION['data'] = $this->model->registeredSessions($_SESSION['user']['email']);
            $this->view->render('session/registered');  
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();  
        }       
    }

    //Unregister current customer from selected seesion and redirects to selected session view.
    function unregister(){
        if($_SESSION['user']['type']==="Customer"){    
            if(isset($_POST) && isset($_POST['unregister_session']))    
                $this->model->unregister($_SESSION['user']['email'],$_POST['unregister_session']);
            header("Location:".BASE_DIR."Session/view");
            die();    
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();  
        }       
    }

    //register current customer from selected seesion and redirects to selected session view.
    function register(){
        if($_SESSION['user']['type']==="Customer"){   
            if(isset($_POST) && isset($_POST['select_session']))
                $this->model->register($_SESSION['user']['email'],$_POST['select_session']);
            header("Location:".BASE_DIR."Session/view");
            die();           
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();            
        }
    }

    //Renders selected session for user view
    function view($p1=0){
        if($_SESSION['user']['type']==="Customer"){
            $temp = isset($_POST['select_session']) ? $_POST['select_session'] :  $_SESSION['data']['select_session'];
            $_SESSION['data'] = $this->model->view($temp);
            $_SESSION['data']['isRegistered'] = $this->model->isSessionRegistered($_SESSION['user']["email"],$temp);
            $_SESSION['data']['select_session'] = $temp;
            $this->view->render('session/view/customer');
        }elseif($_SESSION['user']['type']==="Coach"){
            if($p1==="all"){    //All sessions created by logged in coach
                $_SESSION['data'] = $this->model->createdSessions($_SESSION['user']['email']);
                $this->view->render('session/created');    
            }else{       
                //TODO check logged coach is the creator of selected session
                $temp = isset($_POST['select_session']) ? $_POST['select_session'] :  $_SESSION['data']['select_session'];
                $_SESSION['data'] = $this->model->view($temp);
                $_SESSION['data']['select_session'] = $temp;
                $this->view->render("session/view/creator");  
            }            
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();                
        }

    }

    //Renders search session interface.
    function search(){
        if($_SESSION['user']['type']==="Customer" || $_SESSION['user']['type']==="Coach"){
            $_SESSION['data'] =  $this->model->search();
            $this->view->render('session/searchAll');         
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();                
        }
    }

    
    function create($p1=0){
        if($_SESSION['user']['type']==="Coach"){
            if($p1){                //Creates a session and redirected to create interface
                if(isset($_SESSION['data']))
                    $this->model->add($_SESSION['user']['email'],$_SESSION['data']);
                header("Location:".BASE_DIR."Session/create");
                die();                          
            }else
                $this->view->render('session/create');  //Renders session interface
        }else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();                
        }
    }

    //Deletes a session by created coach and redirected to all sessions interface
    function delete(){
        if($_SESSION['user']['type']==="Coach"){
            $this->model->remove($_POST['delete_session']);
            header("Location:".BASE_DIR."Session/search");
            die();     
        }else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();              
        }
    }

    //Edits a session by created coach and redirected to all sessions interface
    function edit(){
        if($_SESSION['user']['type']==="Coach"){
            $this->model->update($_POST['session_id'],$_POST);
            header("Location:".BASE_DIR."Session/view/my");
            die();
        }else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();               
        }        
    }



}





/*
function customer($action,$p1=0){

if($action=="registered"){
    $_SESSION['data'] = $this->model->registeredSessions($_SESSION['user']['email']);
    $this->view->render('session/registered');   

}elseif($action=="unregister"){
    $this->model->unregister($_SESSION['user']['email'],$_POST['unregister_session']);
    header("Location:".BASE_DIR."Session/customer/select");
    die();       

}elseif($action=="register"){
    $this->model->register($_SESSION['user']['email'],$_POST['select_session']);
    header("Location:".BASE_DIR."Session/customer/select");
    die();

}elseif($action=="select"){
    $temp = isset($_POST['select_session']) ? $_POST['select_session'] :  $_SESSION['data']['select_session'];
    $_SESSION['data'] = $this->model->view($temp);
    $_SESSION['data']['isRegistered'] = $this->model->isSessionRegistered($_SESSION['user']["email"],$temp);
    $_SESSION['data']['select_session'] = $temp;
    $this->view->render('session/view/customer');

}elseif($action=="search"){
    $_SESSION['data'] =  $this->model->search();
    $this->view->render('session/searchAll'); 
}

}

    function coach($action,$p1=0){
        
        if($action==="search"){
            $_SESSION['data'] =  $this->model->search();
            $this->view->render('session/searchAll');                      
        }elseif($action==="select") {
    
        }elseif ($action==="add") {
            if($p1){
                $this->model->add($_SESSION['user']['email'],$_SESSION['data']);
                header("Location:".BASE_DIR."Session/coach/add");
                die();                          
            }else
                $this->view->render('session/create');
        }elseif($action=="view"){

            if($p1=="my"){
                $temp = isset($_POST['select_session']) ? $_POST['select_session'] :  $_SESSION['data']['select_session'];
                $_SESSION['data'] = $this->model->view($temp);
                $_SESSION['data']['select_session'] = $temp;
                $this->view->render("session/view/creator");      
            }elseif($p1=="all"){
                $_SESSION['data'] = $this->model->createdSessions($_SESSION['user']['email']);
                $this->view->render('session/created');
            }

        }elseif($action=="delete"){
            $this->model->remove($_POST['delete_session']);
            header("Location:".BASE_DIR."Session/coach/view/all");
            die();

        }elseif($action=="edit"){
            $this->model->update($_POST['session_id'],$_POST);
            header("Location:".BASE_DIR."Session/coach/view/my");
            die();
        }
    }

*/


?>

