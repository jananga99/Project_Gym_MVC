<?php

class Payment_Controller extends Controller
{

    function __construct(){
        parent::__construct();
    }


    function index(){
        if (isset($_SESSION['logged_user']) && isset($_SESSION['logged_user']['type']) && ($_SESSION['logged_user']['type'] === "Customer" || $_SESSION['logged_user']['type'] === "Coach" || $_SESSION['logged_user']['type'] === "Admin")) {
            header("Location:" . BASE_DIR . "Payment/dash");
            die();
        } else {
            $_SESSION['requested_address'] = BASE_DIR . "Payment";
            header("Location:" . BASE_DIR);
            die();
        }
    }


    //Handles payments requests
    function viewPayment($type){
        if(isset($_SESSION['logged_user'])){
            $_SESSION['payment_data'] = array("Payer_Email"=>$_SESSION['logged_user']['email'],
            "Amount"=>$_SESSION['payment_request_data']['price'],"Payment_Type"=>$type);
            if($type==PAYMENT_SESSION_REGISTER){
                $_SESSION['payment_data']["Item_id"]=$_SESSION['payment_request_data']['session_id'];
            }elseif($type==PAYMENT_SESSION_CREATE){
                $_SESSION['payment_data']["Item_id"]=-1;      //Denote it is item creating
            }elseif($type==PAYMENT_COACH_REGISTER){
                $_SESSION['payment_data']["Item_id"]=$_SESSION['payment_request_data']['coach_email'];      
            }  
            $this->view->render('payment/temp'); 
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewPayment/".$type;
            header("Location:".BASE_DIR);
        }
    }


    //Displaying paying options menu
    function viewPay(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
            $this->view->render('payment/dash');   
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewpay";
            header("Location:".BASE_DIR);
        }
    }


    //Paying the amount
    function pay(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
                //Check for payments
                $this->model->addPayment($_SESSION['payment_data']);
                header("Location:".BASE_DIR."Payment/viewSuccess");
                die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Session/register";
            header("Location:".BASE_DIR);
            die();
        }
    }

    
    //Displaying payment was succesful
    function viewSuccess(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
            $this->view->render('payment/success');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewSuccess";
            header("Location:".BASE_DIR);
            die();
        }
    }


    //Finishing payment procedure
    function finish(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
            if($_SESSION['payment_data']['Payment_Type']==PAYMENT_SESSION_REGISTER)
                header("Location:".BASE_DIR."Session/register/".$_SESSION['payment_data']["Item_id"]);
            elseif($_SESSION['payment_data']['Payment_Type']==PAYMENT_SESSION_CREATE)
                header("Location:".BASE_DIR."Session/create");
            elseif($_SESSION['payment_data']['Payment_Type']==PAYMENT_COACH_REGISTER)
                header("Location:".BASE_DIR."Coach_Registration/register/".$_SESSION['payment_data']["Item_id"]);
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/success";
            header("Location:".BASE_DIR);
            die();
        }
    }
    
}
