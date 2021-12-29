<?php

class Message_Controller extends Controller{

    
    function __construct(){
        parent::__construct();
    }


    //Displaying the message dashbboard
    function index(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $_SESSION['sent_messages'] =  Message::getSentMessages($_SESSION['logged_user']['email']);
            $_SESSION['receieved_messages'] =  Message::getReceievedMessages($_SESSION['logged_user']['email']);
            $this->view->render('message/dash');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message"; 
            header("Location:".BASE_DIR);
            die();
        } 
    }


    //Displaying send menu
    function viewSend(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" ){
            $this->view->render('message/send');         
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message/viewSend";
            header("Location:".BASE_DIR);
            die();
        } 
    }        
   

    //Sending a message
    function send(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" ){
            Message::send($_SESSION['logged_user']['email'],"Coach",$_POST['message']);
            header("Location:".BASE_DIR."Message/viewSend");
            die();            
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message/send";
            header("Location:".BASE_DIR);
            die();
        } 
    }       


    //Marking a message as read
    function markAsRead($message_id){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $this->model->markAsRead();
            header("Location:".BASE_DIR."Message/".$$message_id);
            die();            
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message/markAsRead/".$message_id;
            header("Location:".BASE_DIR);
            die();
        } 
    }
  

    //Delecting a message
    function delete($id){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $this->model->delete();
            header("Location:".BASE_DIR."Message/".$$message_id);
            die();    
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message/delete/".$id;
            header("Location:".BASE_DIR);
            die();
        } 
    }

}

?>