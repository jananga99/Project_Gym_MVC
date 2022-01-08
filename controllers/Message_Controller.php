<?php

class Message_Controller extends Controller{

    
    function __construct(){
        parent::__construct();
    }


    //Displaying the message dashbboard
    function index(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Admin" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Customer")){
            $_SESSION['sent_messages'] =   $this->model->getSentMessages($_SESSION['logged_user']['email']);
            $type_read = "unread";
            if(isset($_POST['sent_select']))
                $type_read = $_POST['sent_select'];
            $_SESSION['receieved_messages'] =   $this->model->getReceievedMessages($_SESSION['logged_user']['email'],$type_read);   
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
            $_SESSION['data'] = array(
                MESSAGE_COACH_TO_ALL_CUSTOMERS=>"All Customers",
                MESSAGE_COACH_TO_REGISTERED_CUSTOMERS=>"Registered Customers"       
            );
            $this->view->render('message/send');         
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin" ){
            $_SESSION['data'] = array(
                    MESSAGE_ADMIN_TO_ALL_CUSTOMERS=>"All Customers",
                    MESSAGE_ADMIN_TO_ALL_COACHES=>"All Coaches"             
                );            
                $this->view->render('message/send');         
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message/viewSend";
            header("Location:".BASE_DIR);
            die();
        } 
    }        
   

    //Sending a message
    function send(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Admin")  ){
            $data = array();
            $data['create_data'] = array('sender_email'=>$_SESSION['logged_user']['email'],'message_type'=>$_POST['message_type'],
                'message'=> $_POST['message']    );
            $data['action'] = "send";
            $this->factory->getModel("Message",$data);
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
            header("Location:".BASE_DIR."Message");
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
            if(isset($_POST['delete_sent_for_me']))
                $this->model->delete("sent_me");
            elseif(isset($_POST['delete_sent_for_everyone']))
                $this->model->delete("sent_everyone");
            elseif(isset($_POST['delete_rec']))
                $this->model->delete("rec");
            header("Location:".BASE_DIR."Message");
            die();    
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Message/delete/".$id;
            header("Location:".BASE_DIR);
            die();
        } 
    }

}

?>