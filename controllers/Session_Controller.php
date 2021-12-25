<?php

class Session_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
            header("Location:".BASE_DIR."Session/customer/search");
            die(); 
        }else{
            header("Location:".BASE_DIR);
            die();
        }
    }

    //Renders registered sessions by a customer
    function registered(){
        if($_SESSION['logged_user']['type']==="Customer"){
            $_SESSION['data'] = $this->model->registeredSessions($_SESSION['logged_user']['email']);
            $this->view->render('session/registered');  
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();  
        }       
    }

    //Unregister current customer from selected seesion and redirects to selected session view.
    //Observable
    function unregister(){
        if($_SESSION['logged_user']['type']==="Customer"){    
            if(isset($_POST) && isset($_POST['unregister_session'])){  
                $this->model->unregister($_SESSION['logged_user']['email'],$_POST['unregister_session']);
                $data=array();
                $data['session_id'] =  $_SESSION['data']['select_session'];
                $data['notification_type'] = NOTIFICATION_SESSION_UNREGISTER;
                $data['customer_email'] = $_SESSION['logged_user']['email'];
                $this->model->notifyObservers($data); 
            }
            header("Location:".BASE_DIR."Session/view");
            die();    
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();  
        }       
    }

    //register current customer from selected seesion and redirects to selected session view.
    //Observable
    function register(){
        if($_SESSION['logged_user']['type']==="Customer"){ 
            if(isset($_SESSION['data']) && isset($_SESSION['data']['select_session'])){
                $this->model->register($_SESSION['logged_user']['email'],$_SESSION['data']['select_session']);
                $data=array();
                $data['session_id'] =  $_SESSION['data']['select_session'];
                $data['notification_type'] = NOTIFICATION_SESSION_REGISTER;
                $data['customer_email'] = $_SESSION['logged_user']['email'];
                $this->model->notifyObservers($data);               
            }    
            header("Location:".BASE_DIR."Payment/success/registerSession");
            die();           
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();            
        }
    }

    function create($p1=0){
        if($_SESSION['logged_user']['type']==="Coach"){
            if($p1){                //Creates a session 
                if(isset($_SESSION['session_create_data'])){
                    $this->model->add($_SESSION['logged_user']['email'],$_SESSION['session_create_data']);
                    $data=array();
                    $data['notification_type'] = NOTIFICATION_SESSION_CREATE;
                    $data['coach_email'] = $_SESSION['logged_user']['email'];
                    $this->model->notifyObservers($data);                       
                }
                header("Location:".BASE_DIR."Payment/success/createSession");
                die();                          
            }else
                $this->view->render('session/create');  //Renders session interface
        }else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();                
        }
    }

    //Renders selected session for user view
    function view($p1=0){
        if($_SESSION['logged_user']['type']==="Customer"){
            $temp = isset($_POST['select_session']) ? $_POST['select_session'] :  $_SESSION['data']['select_session'];
            $_SESSION['data'] = $this->model->view($temp);
            $_SESSION['data']['isRegistered'] = $this->model->isSessionRegistered($_SESSION['logged_user']["email"],$temp);
            $_SESSION['data']['select_session'] = $temp;
            $this->view->render('session/view/customer');
        }elseif($_SESSION['logged_user']['type']==="Coach"){
            if($p1==="all"){    //All sessions created by logged in coach
                $_SESSION['data'] = $this->model->createdSessions($_SESSION['logged_user']['email']);
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
        if($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach"){
            $_SESSION['data'] =  $this->model->search();
            $this->view->render('session/searchAll');         
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();                
        }
    }

    //Deletes a session by created coach and redirected to all sessions interface
    function delete(){
        if($_SESSION['logged_user']['type']==="Coach"){
            $this->model->remove($_POST['delete_session']);
            $data=array();
            $data['notification_type'] = NOTIFICATION_SESSION_DELETE;
            $data['coach_email'] = $_SESSION['logged_user']['email'];
            $data['session_id'] =  $_POST['delete_session'];
            $this->model->notifyObservers($data);     
            header("Location:".BASE_DIR."Session/search");
            die();     
        }else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();              
        }
    }

    //Edits a session by created coach and redirected to all sessions interface
    function edit(){
        if($_SESSION['logged_user']['type']==="Coach"){
            $this->model->updateDetails($_POST['session_id'],$_POST);
            $data=array();
            $data['notification_type'] = NOTIFICATION_SESSION_EDIT;
            $data['coach_email'] = $_SESSION['logged_user']['email'];
            $data['session_id'] = $_POST['session_id'];  
            $this->model->notifyObservers($data);              
            header("Location:".BASE_DIR."Session/view/my");
            die();
        }else{
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();               
        }        
    }



}