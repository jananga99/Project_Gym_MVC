<?php

class Message_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $_SESSION['sent'] =  $this->model->getSentMessages($_SESSION['logged_user']['email']);
            $_SESSION['receieved'] =  $this->model->getReceievedMessages($_SESSION['logged_user']['email']);
            $this->view->render('message/dash');
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }

    function send($sent=0){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" )){
            if($sent){
                $this->model->send(array("coach_email"=>$_SESSION['logged_user']['email'],"details"=>$_POST["details"]));
                header("Location:".BASE_DIR."message/send");
                die();
            }
            $this->view->render('message/send');
            die();            
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }        
    

    function read(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $this->model->markAsRead($_POST['message_id']);
            header("Location:".BASE_DIR."Message");
            die();            
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }
  
    function delete(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $this->model->delete($_POST['message_id']);
            header("Location:".BASE_DIR."Message");
            die();    
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }

}

?>