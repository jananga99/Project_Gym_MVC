<?php

class WorkoutPlan_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user'])){
            header("Location:".BASE_DIR."WorkoutPlan/viewAll");
            die(); 
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan";
            header("Location:".BASE_DIR);
            die();
        }
    }


    //Displaying all available orkout plans
    function viewAll(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" ){
            $_SESSION['plan_arr'] =  WorkoutPlan::getAllPlansForACoach($_SESSION['logged_user']['email']);
            $this->view->render('workoutPlan/viewAll');
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer" ){
            $_SESSION['plan_arr'] = WorkoutPlan::getAllPlansForACustomer($_SESSION['logged_user']['email']);
            $this->view->render('workoutPlan/viewAll');
        }
    }


    //Displaying the plan details according to logged in user
    function view($id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
                $_SESSION['data'] = $this->model->getData();
                $_SESSION['customer_arr'] = $this->model->getCustomersForPlan();
                $this->view->render('workoutPlan/view/coach');
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
                $_SESSION['data'] = $this->model->getData();
                $this->view->render('workoutPlan/view/customer');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan/view/".$id;
            header("Location:".BASE_DIR."Customer");
            die();
        }
    }


    //Creating a workout plan
    function create(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $plan = array();
            $customers = array();
            $step_count = 0;
            $customer_count = 0;
            foreach($_POST as $ind=>$data){
                if($ind==="planTime".$step_count){
                    $plan[$ind] = $data;
                    $plan["planTodo".$step_count] = $_POST["planTodo".$step_count];
                    $step_count+=1; 
                }
                if($ind==="customer_email".$customer_count){
                    $customers[] = $data;
                    $customer_count+=1;
                }
            }           
            WorkoutPlan::create($_SESSION['logged_user']['email'],
                array('plan_name'=>$_POST['plan_name'],'plan'=>$plan));
            $new_plan = new WorkoutPlan(WorkoutPlan::getLatestCreatedPlan($_SESSION['logged_user']['email']));
            $new_plan->addCustomers($customers);
            header("Location:".BASE_DIR."WorkoutPlan/viewCreate");
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan/create".$id;
            header("Location:".BASE_DIR."Coach");
            die();           
        }       
    }


    //Displying creating workout plan interface
    function viewCreate(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $coach_Registration = new Coach_Registration();
            $_SESSION['customer_arr'] = $coach_Registration->registeredCustomers($_SESSION['logged_user']['email']);
            $this->view->render('workoutPlan/create');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan/viewCreate".$id;
            header("Location:".BASE_DIR."Coach");
            die();
        }
    }

    

}








?>