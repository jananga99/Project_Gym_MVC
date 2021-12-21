<?php

class Notification extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && ($_SESSION['user']['type']==="Admin" || $_SESSION['user']['type']==="Coach" || $_SESSION['user']['type']==="Customer")){
            $_SESSION['data'] =  $this->model->getNotifications($_SESSION['user']['email']);
            $this->view->render('notification/notification');
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }

    function read(){
        if(isset($_SESSION['user']) && ($_SESSION['user']['type']==="Admin" || $_SESSION['user']['type']==="Coach" || $_SESSION['user']['type']==="Customer")){
            $this->model->markAsRead($_POST['notification_id']);
            header("Location:".BASE_DIR."Notification");
            die();            
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }
  
    function delete(){
        if(isset($_SESSION['user']) && ($_SESSION['user']['type']==="Admin" || $_SESSION['user']['type']==="Coach" || $_SESSION['user']['type']==="Customer")){
            $this->model->delete($_POST['notification_id']);
            header("Location:".BASE_DIR."Notification");
            die();    
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }

}

?>