<?php

class Payment extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        if (isset($_SESSION['user']) && isset($_SESSION['user']['type']) && ($_SESSION['user']['type'] === "Customer" || $_SESSION['user']['type'] === "Coach" || $_SESSION['user']['type'] === "Admin")) {
            header("Location:" . BASE_DIR . "Payment/dash.php");
            die();
        } else {
            header("Location:" . BASE_DIR);
            die();
        }
    }

    function session($paid = 0)
    {
        if ($paid) {
            if ($_SESSION['user']['type'] === "Customer") {        //Customer paying for a session
                //Check for payments
                // header("Location:".BASE_DIR."Session/register");
                $this->view->render('payment/dash');
                die();
            } elseif ($_SESSION['user']['type'] === "Coach") {   //User registering for a session
                //Check payments
                header("Location:" . BASE_DIR . "Session/create/1");
                die();
            } else {
                header("Location:" . BASE_DIR . "Auth/login/Coach");
                die();
            }
        } else {
            if ($_SESSION['user']['type'] === "Customer") {        //Customer registering for a session.
                $_SESSION['data'] = array();
                $_SESSION['data']['select_session'] = $_POST['select_session'];
<<<<<<< HEAD
                $_SESSION['data']['price'] = $_POST['price'];                
                $this->view->render('payment/temp');   
            }elseif($_SESSION['user']['type']==="Coach"){   //Coach starting a session
                $_POST["startTime"].=":00";
                $_POST["endTime"].=":00";
                $_POST['price']=(float) $_POST['price'];                
                $_SESSION['session_create_data'] = $_POST;
                $this->view->render('payment/temp');         
           }else{
                header("Location:".BASE_DIR."Auth/login/Coach");
                die();               
           } 
=======
                $_SESSION['data']['price'] = $_POST['price'];
                $this->view->render('payment/temp');
            } elseif ($_SESSION['user']['type'] === "Coach") {   //Coach starting a session
                $this->view->render('payment/temp');
            } else {
                header("Location:" . BASE_DIR . "Auth/login/Coach");
                die();
            }
>>>>>>> 16a7ffb7049792299cee7b7af605196a25042de8
        }
    }
}
