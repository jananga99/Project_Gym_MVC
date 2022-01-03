<?php

class Notification_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $type_read = "unread";
            if(isset($_POST['select']))
                $type_read = $_POST['select'];            
            $_SESSION['data'] =  Notification::getNotifications($_SESSION['logged_user']['email'],$type_read);
            $this->view->render('notification/notification');
        }else{
            header("Location:".BASE_DIR);
            die();
        } 
    }

    function markAsRead($id){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $this->model->markAsRead();
            header("Location:".BASE_DIR."Notification");
            die();            
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Notification/markAsRead/".$id;
            header("Location:".BASE_DIR);
            die();
        } 
    }
  
    function delete($id){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $this->model->delete();
            header("Location:".BASE_DIR."Notification");
            die();    
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Notification/delete/".$id;
            header("Location:".BASE_DIR);
            die();
        } 
    }

}

?>