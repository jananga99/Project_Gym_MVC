<?php

class Session_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
       
    }


    //Creating Virtual Gym Sessions
    function create($submitted=0){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            if($submitted){
                //Do validations TODO
                $this->model->createSession(array("Coach_Email"=>$_SESSION['logged_user']['email'],
                "Session_Name"=>$_POST['sessionName'],"Date"=>$_POST["date"],"Start_Time"=>$_POST["startTime"],
                "End_Time"=>$_POST["endTime"],"Num_Participants"=>$_POST["maxParticipants"],
                "Price"=>$_POST["price"],"Details"=>$_POST["details"]),"ssssssds");
                header("Location:".BASE_DIR.'Session/create');
                die();               
            }
            else{
                $this->view->render('Session/create');
            } 
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/create";
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();
        }
    }


    //Displaying Gym Sessons created by himself
    function createdByMe(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $_SESSION['data'] = Session::createdSessions($_SESSION['logged_user']['email']);
            $this->view->render('Session/createdSessionsByACoach');  
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/createdByMe";
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();
        }  
    }
    
                
    //Displaying the selected session
    function view($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $_SESSION['data'] = $this->model->getData();
            if($_SESSION['logged_user']['email']===$this->model->getCreatedCoach()){   //view by creator
                $this->view->render("Session/view/creator");  
            }else{     //view by another coach
                $this->view->render("Session/view/coach");
            }
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){  //view by a customer
            $_SESSION['data'] = $this->model->getData();
            $_SESSION['data']['isRegistered'] = $this->model->isCustomerRegistered($_SESSION['logged_user']['email']);
            $this->view->render("Session/view/customer");
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/view/".$session_id;
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();
        } 
    }


    //Displaying all available sessions
    function viewAll(){
        $_SESSION['data'] = Session::getAllSessions();
        $this->view->render("Session/viewAll");
    }


    //Delecting the session
    function delete($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" && $_SESSION['logged_user']['email']===$this->model->getCreatedCoach()){
            $this->model->delete($session_id); 
            header("Location:".BASE_DIR."Session/createdByMe");
            die();     
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/delete/".$session_id;
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();              
        }
    }


    //Editing the seesiosn
    function edit($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" && $_SESSION['logged_user']['email']===$this->model->getCreatedCoach()){
            $this->model->edit(array("Coach_Email"=>$_SESSION['logged_user']['email'],
            "Session_Name"=>$_POST['session_name'],"Date"=>$_POST["date"],"Start_Time"=>$_POST["startTime"],
            "End_Time"=>$_POST["endTime"],"Num_Participants"=>$_POST["num_participants"],
            "Price"=>$_POST["price"],"Details"=>$_POST["details"]),"ssssssds");         
            header("Location:".BASE_DIR."Session/view/".$session_id);
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/delete/".$session_id;
            header("Location:".BASE_DIR."Auth/login/Coach");
            die();              
        }        
    }    


    //registering current customer for the session
    //Observable
    function register($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){ 
            $this->model->register($_SESSION['logged_user']['email'],$session_id);          
                header("Location:".BASE_DIR."Session/view/".$session_id);
                die();                   
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/register/".$session_id;
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();            
        }
    }


    //Unregister current customer from the session
    //Observable
    function unregister($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){ 
            $this->model->unregister($_SESSION['logged_user']['email'],$session_id);
            header("Location:".BASE_DIR."Session/view/".$session_id);
            die();    
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/unregister/".$session_id;
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();  
        }       
    }


    //Displaying registered sessions by a customer
    function registeredByMe(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){ 
            $_SESSION['data'] = Session::registeredSessions($_SESSION['logged_user']['email']);
            $this->view->render('session/registeredSessionsByACustomer');  
        }else{
            header("Location:".BASE_DIR."Auth/login/Customer");
            die();  
        }       
    }


////////////////////////////////////////////////////////////////////////////////////////////////






//////////////////////////////////////////////////////////////////////////////////////
    function create1($p1=0){
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




}