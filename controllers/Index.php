<?php
class Index extends Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){
        if(isset($_SESSION['user']) && isset($_SESSION['user']['type']) && ($_SESSION['user']['type']==="Customer" || $_SESSION['user']['type']==="Coach" || $_SESSION['user']['type']==="Admin")){
            header("Location:".BASE_DIR.$_SESSION['user']['type']);
            die();
        }
        $this->view->render('access');
    }

}



?>