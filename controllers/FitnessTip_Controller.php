<?php

class FitnessTip_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && $_SESSION['user']['type']==="Customer"){
            header("Location:".BASE_DIR."FitnessTip/search");
            die(); 
        }else{
            header("Location:".BASE_DIR);
            die();
        }
    }

    function search(){
        $sort_arr = isset($_SESSION['data']['sort_arr']) ? $_SESSION['data']['sort_arr'] : 0;  
        $_SESSION['data'] =  $this->model->search($sort_arr);
        $this->view->render('fitnessTip/searchAll');        
    }

    function create(){
        $this->view->render('fitnessTip/create');
    }

    function add(){
        $this->model->add($_SESSION['data']);
        header("Location:".BASE_DIR."FitnessTip/create");
        die();
    }


}








?>