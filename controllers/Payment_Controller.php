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
      //  echo $type;
       
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
          //  print_r($_SESSION['payment_data']); 
            //die();
            $this->view->render('payment/temp'); 
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewPayment/".$type;
            header("Location:".BASE_DIR."Auth/login");
        }
    }


    //Displaying paying options menu
    function viewPay(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
            $_SESSION['payment_data']['Payment_Type'] = $_POST['payment_type'];
            if (!($_SESSION['payment_data']['Payment_Type'] == PAYMENT_SESSION_CREATE))
                $_SESSION['payment_data']['Item_id'] = $_POST['item_id'];
            else{
                $_SESSION['payment_data']['Item_id'] = -1;
            }
            $this->view->render('payment/dash');   
        }else{
            die();
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewpay";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }


    //Paying the amount
    function pay(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
       //     if(!$this->validator->validateName($_POST["name"])){
      //          $_SESSION['msg'] = "Person Name is not valid";
      //      }elseif(!$this->validator->validateCardNumber($_POST["card_number"])){
       //         $_SESSION['msg'] = "Credit Card number is not valid";
       //     }elseif(!$this->validator->validateExpiry($_POST["expiry"])){
       //             $_SESSION['msg'] = "Expiry is not valid";
        //    }elseif(!$this->validator->validateCVC($_POST["cvc"])){
       //             $_SESSION['msg'] = "CVC is not valid";
       //     }else{
                //Check for payments
                $data=array('create_data'=>$_SESSION['payment_data']);
                $this->factory->getModel("Payment",$data);
                header("Location:".BASE_DIR."Payment/viewSuccess");
                die();
       //     }
        //    header("Location:".BASE_DIR."Payment/viewPay");
        //    die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/pay";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }

    
    //Displaying payment was succesful
    function viewSuccess(){
        if(isset($_SESSION['logged_user']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach")){        
            $this->view->render('payment/success');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewSuccess";
            header("Location:".BASE_DIR."Auth/login");
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
            $_SESSION['requested_address'] = BASE_DIR."Payment/finish";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }
    

    //Displaying set prices interface
    function viewSetPrice(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){
            $_SESSION['data'] = $this->model->getPrices();
            $this->view->render('payment/prices');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/viewSetPrice";
            header("Location:".BASE_DIR."Auth/login");
            die();            
        }
    }


    //Sets Prices
    function setPrice($action){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Admin"){  
            if($action==="create"){
                if(!$this->validator->validateText($_POST['price_type'])){
                    $_SESSION['msg'] = "Price Type cannot be empty";
                }elseif(!$this->validator->validatePrice($_POST['price'])){
                    $_SESSION['msg'] = "Price is not valid";
                }
                else{                
                    $this->model->addPrice(array("Price_Type"=>$_POST['price_type'],"Price"=>$_POST['price'],"Details"=>$_POST['price_details']));
                    $_SESSION['msg'] = "Price set successfully";
                }
            }elseif($action==="edit"){
                $this->model->editPrice($_POST['price_id'],array("Price_Type"=>$_POST['price_type'],"Price"=>$_POST['price'],"Details"=>$_POST['price_details']));
            }elseif($action==="delete"){
                $this->model->deletePrice($_POST['price_id']);
            }
            header("Location:".BASE_DIR."Payment/viewSetPrice");
        }else{
            $_SESSION['requested_address'] = BASE_DIR."Payment/setPrice/".$action;
            header("Location:".BASE_DIR."Auth/login");        
        }
        die();
    }

}
