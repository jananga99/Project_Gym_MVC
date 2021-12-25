<?php

class App{

    private $_url= null;
    private $_controller = null;

    function __construct(){
        
        //Gets the url in request
        $this->_getURL();

        //If url is empty load default construtcor
        if(empty($this->_url[0])){
            $this->_loadDefaultController();
            return;
        }

        //Loads the controller
        if($this->_loadController()){
            $this->_loadControllerMethod();
        }
        

    }

    //returns an array of parameters giving to index?url=
    private function _getURL(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;  
        $url = rtrim($url, '/'); 
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/',$url);
    }

    private function _loadDefaultController(){
        require 'controllers/Index_Controller.php';
        $this->_controller = new Index_Controller();
        $this->_controller->index();
    }

    //Loads controller according to first parameter of url
    private function _loadController(){
        $controllerName = $this->_url[0].'_Controller';
        $file = 'controllers/'.$controllerName.'.php';
        if(file_exists($file)){
            require $file;
            $this->_controller = new $controllerName;
            $this->_controller->loadModel($this->_url[0]);
            return TRUE;
        }else{
            echo "Sorry page not found";
            return FALSE;
        }
    }

    //Loads controller according to second parameter of url
    private function _loadControllerMethod(){
        $urlLength = count($this->_url);     
        if($urlLength > 1){
            if(!method_exists($this->_controller, $this->_url[1])){
                echo "Requested method not found."; 
                exit;
            }
        }

        //Paremeters after second in url are parameters to controller method
        switch ($urlLength){
            case 6:
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4],$this->_url[5]);
                break;
            case 5:
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3],$this->_url[4]);
                break;
            case 4:
                $this->_controller->{$this->_url[1]}($this->_url[2],$this->_url[3]);
                break;
            case 3:
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;
            case 2:
                $this->_controller->{$this->_url[1]}();
                break;
            default:
                $this->_controller->index();
                break;                            
        }

    }

}



?>