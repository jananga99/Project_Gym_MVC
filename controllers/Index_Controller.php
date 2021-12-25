<?php
class Index_Controller extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['logged_user']) && isset($_SESSION['logged_user']['type']) && ($_SESSION['logged_user']['type']==="Customer" || $_SESSION['logged_user']['type']==="Coach" || $_SESSION['logged_user']['type']==="Admin")){
            header("Location:".BASE_DIR.$_SESSION['logged_user']['type']);
            die();
        }
        $this->view->render('access');
    }

}



?>