<?php
    class Report_Controller extends Controller{

        function __construct(){
            parent::__construct();
        }

        function index(){
            $this->view->render('Report/Report');
        }

        function submit_report(){
            $this->model->submit_report($_POST['reason'],$_POST['email']);
            header("Location:".BASE_DIR."Coach/view/".$_POST['email']);
            die();
        }
        
        function view_create($email){
            $_SESSION['report_email'] = $email;
            $this->view->render('Report/Report');
        }
       
            
    }
    
?>