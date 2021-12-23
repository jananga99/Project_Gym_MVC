<?php

class WorkoutPlan extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
            header("Location:".BASE_DIR."WorkoutPlan/view/1");
            die(); 
        }else{
            header("Location:".BASE_DIR);
            die();
        }
    }

    function view($all=0){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Coach"){
            if($all){
                $_SESSION['plan_arr'] =  $this->model->getAllPlansForACoach($_SESSION['user']['email']);
                $this->view->render('workoutPlan/view/coach_all');
            }else{
                $_SESSION['plan'] = $this->model->getPlan($_POST['plan_id']);
                $_SESSION['customer_arr'] = $this->model->getCustomersForPlan($_POST['plan_id']);
                $this->view->render('workoutPlan/view/coach');
            }
        }if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
            if($all){
                $_SESSION['plan_arr'] =  $this->model->getAllPlansForACustomer($_SESSION['user']['email']);
                $this->view->render('workoutPlan/view/customer_all');
            }else{
                $_SESSION['plan'] = $this->model->getPlan($_POST['plan_id']);
                $this->view->render('workoutPlan/view/customer');
            }        
        }else{
            header("Location:".BASE_DIR."Customer");
            die();
        }
    }

    function create($p=0){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Coach"){
            if($p){
                $data=array();
                $data['plan_name'] = $_POST['plan_name'];
                $data['plan'] = $_POST['plan'];
                $this->model->create($_SESSION['user']['email'],$data);
                $plan_id = $this->model->getLatestCreatedPlan($_SESSION['user']['email']);
                $this->model->addCustomers($plan_id,$_POST['added_customers']);
                header("Location:".BASE_DIR."WorkoutPlan/create");
                die();
            }else{
                $_SESSION['customer_arr'] = $this->model->getRegisterCustomersForCoach($_SESSION['user']['email']);
                $this->view->render('workoutPlan/create');
            }
        }else{
            header("Location:".BASE_DIR."Coach");
            die();
        }
    }

    

}








?>