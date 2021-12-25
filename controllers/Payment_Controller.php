<?php

class Payment_Controller extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        if (isset($_SESSION['logged_user']) && isset($_SESSION['logged_user']['type']) && ($_SESSION['logged_user']['type'] === "Customer" || $_SESSION['logged_user']['type'] === "Coach" || $_SESSION['logged_user']['type'] === "Admin")) {
            header("Location:" . BASE_DIR . "Payment/dash.php");
            die();
        } else {
            header("Location:" . BASE_DIR);
            die();
        }
    }

    function pay($flag){
        $_SESSION['payment_flag'] = $flag;
        $this->view->render('payment/dash');   
    }

    function success($flag){
        $_SESSION['back_flag'] = $flag;
        $this->view->render('payment/success');
    }

    function coachRegister($paid=0){
        $coach_register_price =100;
        if ($_SESSION['logged_user']['type'] === "Customer") {
            if($paid){
                //Check Payments
                header("Location:".BASE_DIR."Customer/coach/add");
                die();
            }else{
                $_SESSION['data'] = array();
                $_SESSION['data']['register_coach'] = $_POST['select_email'];
                $_SESSION['data']['price'] = $coach_register_price;   
                $_SESSION['data']['flag'] = "register_coach";
                $this->view->render('payment/temp');
            }
        }else{
            header("Location:" . BASE_DIR . "Auth/login/Customer");
            die();
        } 
    }

    function session($paid = 0)
    {
        if ($paid) {
            if ($_SESSION['logged_user']['type'] === "Customer") {        //Customer paying for a session
                //Check for payments
                header("Location:".BASE_DIR."Session/register");
                die();
            } elseif ($_SESSION['logged_user']['type'] === "Coach") {   //User registering for a session
                //Check payments
                header("Location:" . BASE_DIR . "Session/create/1");
                die();
            } else {
                header("Location:" . BASE_DIR . "Auth/login/Coach");
                die();
            }
        } else {
            if ($_SESSION['logged_user']['type'] === "Customer") {        //Customer registering for a session.
                $_SESSION['data'] = array();
                $_SESSION['data']['select_session'] = $_POST['select_session'];
                $_SESSION['data']['price'] = $_POST['price'];   
                $_SESSION['data']['flag'] = "register_session";             
                $this->view->render('payment/temp');   
            }elseif($_SESSION['logged_user']['type']==="Coach"){   //Coach starting a session
                $_POST["startTime"].=":00";
                $_POST["endTime"].=":00";
                $_POST['price']=(float) $_POST['price'];                
                $_SESSION['session_create_data'] = $_POST;
                $_SESSION['data']['flag'] = "create_session";  
                $this->view->render('payment/temp');         
           }else{
                header("Location:".BASE_DIR."Auth/login/Coach");
                die();               
           } 
        }
    }
}
