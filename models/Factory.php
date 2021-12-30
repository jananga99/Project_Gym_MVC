<?php

class Factory extends Model{

    private static $instance;

    private function __construct(){
        parent::__construct();
    }

    //Singleton is applied for factory
    private function getInstance(){
        if(self::$instance==NULL)
            self::$instance = new Factory();
        return self::$instance;
    }

    //Creates model objects checking conditions
    static function getModel($modelName){
        if($modelName==="Factory")
            return self::getInstance();
        $path = 'models/'.$modelName.'.php';
        if(file_exists($path)){
            
                require 'models/User.php';
                require $path;
                $model=0;
                $first_para = self::_getFirstParametre();

                if($modelName==="Auth"){
                    $model = new Auth();
                }

                elseif($modelName==="Customer"){
                    require 'models/Coach_Registration.php';
                    require 'models/Coach.php';
                    if(!(self::_getFunction()==="create") && isset($_SESSION['logged_user']) &&
                    $_SESSION['logged_user']['type']==="Customer")
                        $model = new Customer($_SESSION['logged_user']['email']);
                    else
                        Customer::setDatabase();
                }
                
                elseif($modelName==="Coach"){
                    require 'models/Coach_Registration.php';
                    require 'models/Customer.php';
                    if(!(self::_getFunction()==="create") && isset($_SESSION['logged_user']) &&
                    $_SESSION['logged_user']['type']==="Coach")
                        $model = new Coach($_SESSION['logged_user']['email']);
                    else    //For static access
                        Coach::setDatabase();
                }

                elseif($modelName==="Admin"){
                    require 'models/Coach_Registration.php';
                    if(!(self::_getFunction()==="create") && isset($_SESSION['logged_user']) &&
                    $_SESSION['logged_user']['type']==="Admin")
                        $model = new Admin($_SESSION['logged_user']['email']);
                    else
                        Admin::setDatabase();
                }

                elseif($modelName==="Coach_Registration"){
                    $model = new Coach_Registration();
                }

                elseif($modelName==="Payment"){
                    $model = new Payment();
                }


                elseif($modelName==="Session"){
                    require "models/Coach.php";
                    require "models/Customer.php";
                    require "models/Admin.php";
                    require 'models/Coach_Registration.php';
                    require 'models/Notification.php';
                    if(self::_getFirstParametre())
                        $model = new Session(self::_getFirstParametre());
                    else
                        Session::setDatabase();
                
                }

                elseif($modelName==="Notification"){
                    if(self::_getFirstParametre())
                        $model = new Notification(self::_getFirstParametre());
                    else
                        Notification::setDatabase();                    
                }

                elseif($modelName==="Message"){
                    require "models/Coach.php";
                    require "models/Customer.php";
                    require "models/Admin.php";
                    require 'models/Coach_Registration.php';
                    require 'models/MessageMediator.php';
                    if(self::_getFirstParametre())    
                        $model = new Message(self::_getFirstParametre());
                    else
                        Message::setDatabase();                
                }
                

                elseif($modelName==="FitnessTip"){
                    if(self::_getFirstParametre())    
                        $model = new FitnessTip(self::_getFirstParametre());
                    else
                        FitnessTip::setDatabase();
                }


                elseif($modelName==="WorkoutPlan"){
                    require 'models/Coach_Registration.php';
                    if(self::_getFirstParametre())    
                        $model = new WorkoutPlan(self::_getFirstParametre());
                    else
                        WorkoutPlan::setDatabase();
                }

                return $model;
        }       
        return 0;
    }

    //returns the function part of the url
    private static function _getFunction(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;  
        $url = rtrim($url, '/'); 
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/',$url);
        if(isset($url[1]))
            return $url[1];
        return NULL; 
    }


    //returns the function part of the url
    private static function _getFirstParametre(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;  
        $url = rtrim($url, '/'); 
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/',$url);
        if(isset($url[2]))
            return $url[2];
        return NULL; 
    }    



}


?>