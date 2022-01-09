<?php

class Session_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user'])){
            header("Location:".BASE_DIR."Session/viewAll");
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }      
    }


    //Providing display to create sessiosn
    function viewCreate(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $_SESSION['data'] =  $this->model->getPrice("Create_Session");
            $this->view->render('Session/create');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/viewCreate";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }            
    }    


    //Validating and redirects to payments
    function checkCreate(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $_POST["startTime"].=":00";
            $_POST["endTime"].=":00";
            if(!$this->validator->validateText($_POST['sessionName'])){
                $_SESSION['msg'] = "Session name cannot be empty";
            }elseif(!$this->validator->validatePositiveNumber($_POST['maxParticipants'])){
                $_SESSION['msg'] = "Number of participants is not valid";
            }elseif(!$this->validator->validatePrice($_POST['price'])){
                $_SESSION['msg'] = "Register price is not valid";
            }elseif(!$this->validator->validate24Time($_POST['startTime'])){
                $_SESSION['msg'] = "Start Time is not valid";
            }elseif(!$this->validator->validate24Time($_POST['endTime'])){
                $_SESSION['msg'] = "End Time is not valid";
            }elseif(!$this->validator->validate24TimeDuration($_POST['startTime'],$_POST['endTime'])){
                $_SESSION['msg'] = "End time must be after start time";
            }elseif(!$this->validator->validateUpcomingDate($_POST['date'])){
                $_SESSION['msg'] = "Date is not valid. (Must be a date after or on tomorrow.)";
            }else{
                $_SESSION['payment_request_data'] =  array("Coach_Email"=>$_SESSION['logged_user']['email'],
                "Session_Name"=>$_POST['sessionName'],"Date"=>$_POST["date"],"Start_Time"=>$_POST["startTime"],
                "End_Time"=>$_POST["endTime"],"Num_Participants"=>$_POST["maxParticipants"],"price"=>$_POST["createPrice"],
                "Details"=>$_POST["details"],"registerPrice"=>$_POST['price']) ;          
                header("Location:".BASE_DIR."Payment/viewPayment/".PAYMENT_SESSION_CREATE);
                die();
            }
            header("Location:".BASE_DIR."Session/viewCreate");
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/checkCreate";
            header("Location:".BASE_DIR."Auth/login");
        }
        die();
    }


    //Creating Virtual Gym Sessions 
    function create(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $data = array();
            $data['create_data'] = array(
                "Coach_Email"=>$_SESSION['payment_request_data']["Coach_Email"],
                "Session_Name"=>$_SESSION['payment_request_data']["Session_Name"],
                "Date"=>$_SESSION['payment_request_data']["Date"],
                "Start_Time"=>$_SESSION['payment_request_data']["Start_Time"],
                "End_Time"=>$_SESSION['payment_request_data']["End_Time"],
                "Num_Participants"=>$_SESSION['payment_request_data']["Num_Participants"],
                "price"=>$_SESSION['payment_request_data']["registerPrice"],
                "Details"=>$_SESSION['payment_request_data']["Details"]
            );
            $this->factory->getModel("Session",$data);
            unset($_SESSION['payment_data']);
            header("Location:".BASE_DIR."Session/createdByMe");
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/create";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }


    //Displaying Gym Sessons created by himself
    function createdByMe(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $_SESSION['data'] = $this->model->createdSessions($_SESSION['logged_user']['email']);
            $this->view->render('Session/createdSessionsByACoach');  
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/createdByMe";
            header("Location:".BASE_DIR."Auth/login");
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
            $_SESSION['data']['isRegistered'] = $this->model->isCustomerRegistered($_SESSION['logged_user']['email'],$session_id);
            $this->view->render("Session/view/customer");
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){
            $_SESSION['data'] = $this->model->getData();
            $this->view->render("Session/view/admin");
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/view/".$session_id;
            header("Location:".BASE_DIR."Auth/login");
            die();
        } 
    }


    //Displaying all available sessions
    function viewAll(){
        if(isset($_SESSION['logged_user'])){
            $session_arr = array();
            $arr = array();
            if(isset($_POST['by_registered']) && $_POST['by_registered']==="registered")
                $arr =  $this->model-> registeredSessions($_SESSION['logged_user']['email']);
            elseif(isset($_POST['by_registered']) && $_POST['by_registered']==="unregistered")
                $arr =  $this->model->unregisteredSessions($_SESSION['logged_user']['email']);
            else
                $arr = $this->model->getAllSessions();
            if(isset($_POST["order_by_date"]) && $_POST["order_by_date"]==="decending")
                $arr = array_reverse($arr);
            $coach_arr = array();
            if($_SESSION['logged_user']['type']==="Customer")
                $coach_arr = $this->model->registeredCoachesForCustomer($_SESSION['logged_user']['email']);
            foreach($arr as $row){
                if(isset($_POST["only_registered_coaches"]) && $_POST["only_registered_coaches"]==="on")    
                    if(!in_array($row['Coach_Email'],$coach_arr))   continue;
                if(isset($_POST['by_time'])){
                    if($_POST['by_time']==="all")
                        $session_arr[] = $row;
                    elseif($_POST['by_time']==="upcoming" && date('Y-m-d')<=$row['Date'])
                        $session_arr[] = $row;
                    elseif($_POST['by_time']==="previous" && date('Y-m-d')>$row['Date'])
                        $session_arr[] = $row;
                }else
                    if(date('Y-m-d')<=$row['Date'])
                        $session_arr[] = $row;
            }  
            $_SESSION['data'] = $session_arr;
            $this->view->render("Session/viewAll");  
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/viewAll";
            header("Location:".BASE_DIR."Auth/login");
            die();            
        }  
    }


    //Delecting the session
    function delete($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" && $_SESSION['logged_user']['email']===$this->model->getCreatedCoach()){
            $this->model->delete($session_id); 
            header("Location:".BASE_DIR."Session/createdByMe");
            die();     
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/delete/".$session_id;
            header("Location:".BASE_DIR."Auth/login");
            die();              
        }
    }


    //Editing the seesiosn
    function edit($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" && $_SESSION['logged_user']['email']===$this->model->getCreatedCoach()){
            if(!$this->validator->validateText($_POST['session_name'])){
                $_SESSION['msg'] = "Session name cannot be empty";
            }elseif(!$this->validator->validatePositiveNumber($_POST['num_participants'])){
                $_SESSION['msg'] = "Number of participants is not valid";
            }elseif(!$this->validator->validatePrice($_POST['price'])){
                $_SESSION['msg'] = "Register price is not valid";
            }elseif(!$this->validator->validate24Time($_POST['startTime'])){
                $_SESSION['msg'] = "Start Time is not valid";
            }elseif(!$this->validator->validate24Time($_POST['endTime'])){
                $_SESSION['msg'] = "End Time is not valid";
            }elseif(!$this->validator->validate24TimeDuration($_POST['startTime'],$_POST['endTime'])){
                $_SESSION['msg'] = "End time must be after start time";
            }elseif(!$this->validator->validateUpcomingDate($_POST['date'])){
                $_SESSION['msg'] = "Date is not valid. (Must be a date after or on tomorrow.)";
            }else{            
                $this->model->edit(array("Coach_Email"=>$_SESSION['logged_user']['email'],
                "Session_Name"=>$_POST['session_name'],"Date"=>$_POST["date"],"Start_Time"=>$_POST["startTime"],
                "End_Time"=>$_POST["endTime"],"Num_Participants"=>$_POST["num_participants"],
                "Price"=>$_POST["price"],"Details"=>$_POST["details"]),"ssssssds");  
                $_SESSION['msg'] = "Session edited successfully";
            }       
            header("Location:".BASE_DIR."Session/view/".$session_id);
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/edit/".$session_id;
            header("Location:".BASE_DIR."Auth/login");
            die();              
        }        
    }    


    //registering current customer for the session or redirecting for payments
    //Observable
    function register($session_id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){ 
            if(isset($_SESSION['payment_data']) && $_SESSION['payment_data']['Item_id']===$session_id &&
            $_SESSION['payment_data']['Payer_Email']===$_SESSION['logged_user']['email'] &&
            $_SESSION['payment_data']['Payment_Type']==PAYMENT_SESSION_REGISTER){
                $this->model->register($_SESSION['logged_user']['email'],$session_id);   
                unset($_SESSION['payment_data']);
                header("Location:".BASE_DIR."Session/view/".$session_id);   
            }else{
                $_SESSION['payment_request_data'] = array("price"=>$_POST['price'],"session_id"=>$session_id);                 
                header("Location:".BASE_DIR."Payment/viewPayment/".PAYMENT_SESSION_REGISTER);
            }
            die();    
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/register/".$session_id;
            header("Location:".BASE_DIR."Auth/login");
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
            header("Location:".BASE_DIR."Auth/login");
            die();  
        }       
    }


    //Displaying registered sessions by a customer
    function registeredByMe(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){ 
            $_SESSION['data'] = $this->model->registeredSessions($_SESSION['logged_user']['email']);
            $this->view->render('session/registeredSessionsByACustomer');  
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/registeredByMe";
            header("Location:".BASE_DIR."Auth/login");
            die();  
        }       
    }

}