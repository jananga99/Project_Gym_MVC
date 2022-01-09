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
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }


    //Displaying all available orkout plans
    function viewAll(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach" ){
            $_SESSION['plan_arr'] = $this->model->getAllPlansForACoach($_SESSION['logged_user']['email']);
            $this->view->render('workoutPlan/viewAll');
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer" ){
            $_SESSION['plan_arr'] = $this->model->getAllPlansForACustomer($_SESSION['logged_user']['email']);
            $this->view->render('workoutPlan/viewAll');
        }
    }


    //Displaying the plan details according to logged in user
    function view($id){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
                $_SESSION['data'] = $this->model->getPlan($id);
                $_SESSION['customer_arr'] = $this->model->getCustomersForPlan();
                $this->view->render('workoutPlan/view/coach');
        }elseif(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Customer"){
                $_SESSION['data'] = $this->model->getPlan($id);
                $this->view->render('workoutPlan/view/customer');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan/view/".$id;
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }


    //Creating a workout plan
    function create(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $validateSuccess = 1;
            $plan = array();
            $customers = array();
            $step_count = 0;
            $customer_count = 0;
            foreach($_POST as $ind=>$data){
                if($ind==="planTime".$step_count){
                    if(!$this->validator->validate24Time($data)){
                        $_SESSION['msg'] = "Plan Time".$step_count." is not valid";
                        $validateSuccess=0;
                        break;
                    }elseif(!$this->validator->validateText($_POST["planTodo".$step_count])){
                        $_SESSION['msg'] = "Plan To Do".$step_count." cannot be empty";
                        $validateSuccess=0;
                        break;
                    }
                    $plan[$ind] = $data;
                    $plan["planTodo".$step_count] = $_POST["planTodo".$step_count];
                    $step_count+=1; 
                }
                if(substr($ind,0,14)==="customer_email"){
                    $customers[] = $data;
                    $customer_count+=1;
                }
            }  
            if($validateSuccess==0){ 
            }elseif(!$this->validator->validateText($_POST['plan_name'])){
                $_SESSION['msg'] = "Plan name cannot be empty";
            }else{   
                $data = array();
                $data['create_data'] = array('plan_name'=>$_POST['plan_name'],'plan'=>serialize($plan),"Coach_Email"=>$_SESSION['logged_user']['email']);
                $new_plan = $this->factory->getModel("WorkoutPlan",$data);
                $new_plan->addCustomers($customers);
                $_SESSION['msg'] = "Workout Plan created successfully";
            }
            header("Location:".BASE_DIR."WorkoutPlan/viewCreate");
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan/create".$id;
            header("Location:".BASE_DIR."Auth/login");
            die();           
        }       
    }


    //Displying creating workout plan interface
    function viewCreate(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $_SESSION['customer_arr'] = $this->model->registeredCustomersForCoach($_SESSION['logged_user']['email']);
            $this->view->render('workoutPlan/create');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."WorkoutPlan/viewCreate".$id;
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }

    

}








?>