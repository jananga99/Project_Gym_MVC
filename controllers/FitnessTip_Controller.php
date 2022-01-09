<?php

class FitnessTip_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        header("Location:".BASE_DIR."FitnessTip/viewAll");
        die(); 
    }


    //Displaying all fitness tips
    function viewAll(){
        $arr=0;
        if(isset($_POST['gender']))
            $arr = array('for_which_gender'=>$_POST['gender']);
        $_SESSION['data'] =  $this->model->getAllFitnessTips($arr);
        $this->view->render('fitnessTip/viewAll');        
    }


    //Displaying fitness tip creating interfcae
    function viewCreate(){
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){
            $this->view->render('fitnessTip/create');
        }else{
            $_SESSION['requested_address'] = BASE_DIR."FitnessTip/viewCreate";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }
    }


    //Creating the fitness tip
    function create(){   
        if(isset($_SESSION['logged_user']) && $_SESSION['logged_user']['type']==="Coach"){        
            if(!$this->validator->validateGender($_POST['gender'])){
                $_SESSION['msg'] = "Gender is not valid";
            }else{
                $data = array();
                $data['create_data'] = array("Tip"=>$_POST['tip'],"for_which_gender"=>$_POST['gender']);
                $this->factory->getModel("FitnessTip",$data);
                $_SESSION['msg'] = "FitnessTip added successfully";
            }
            header("Location:".BASE_DIR."FitnessTip/viewCreate");
            die();
        }else{
            $_SESSION['requested_address'] = BASE_DIR."FitnessTip/create";
            header("Location:".BASE_DIR."Auth/login");
            die();
        }            
    }
}








?>