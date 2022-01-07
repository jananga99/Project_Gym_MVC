<?php

class Factory{

    //Creates model objects checking conditions
    function getModel($modelName,$data){
        
        $path = 'models/'.$modelName.'.php';    
        $model=0;
        if(file_exists($path)){
                
                
               // $function = $this->_getFunction();
                //$para_to_function = $this->_getFirstParametre();

                if(  (isset($data['id'])     && !(is_null($data['id'])) )          || isset($data['create_data'])){
                    require_once $path;
                    $model = new $modelName($data);

                }
                
                /*
                
                if($modelName==="Auth"){
                    require_once $path;
                    $model = new Auth();
                }

                elseif($modelName==="Customer"){
                    if(isset($data['id'])){
                        require_once $path;
                        $model = new Customer($id);
                    }
                    if($this->_getFirstParametre()){
                        require_once $path;
                        $model = new Customer($_SESSION['logged_user']['email']);
                    }
                }
                
                elseif($modelName==="Coach"){
                    if($id){
                        require_once $path;
                        $model = new Coach($id,$med);
                    }                        
                    elseif($this->_getFirstParametre()){
                        require_once $path;
                        $model = new Coach($_SESSION['logged_user']['email']);
                    }                        
                }

                elseif($modelName==="Admin"){
                    if($id){
                        require_once $path;
                        $model = new Admin($id);
                    }
                    if($this->_getFirstParametre()){
                        require_once $path;
                        $model = new Admin($_SESSION['logged_user']['email']);
                    }
                }

                elseif($modelName==="Coach_Registration"){
                    if($id){
                        require_once $path;
                        $model = new Coach_Registration($id);    
                    }
                    elseif($this->_getFirstParametre()){
                        require_once $path;
                        $model = new Coach_Registration($this->_getFirstParametre());    
                    }
                }

                elseif($modelName==="Payment"){
                    require_once $path;
                    $model = new Payment();
                }


                elseif($modelName==="Session"){
                    if($id){
                        require_once $path;
                        $model = new Session($id);
                    }  
                    if($this->_getFirstParametre()){
                        require_once $path;
                        $model = new Session($this->_getFirstParametre());
                    }
                }

                elseif($modelName==="Notification"){
                    if($this->_getFirstParametre()){
                        require_once $path;
                        $model = new Notification($this->_getFirstParametre());
                    }                    
                }

                elseif($modelName==="Message"){
                    if($this->_getFirstParametre()){
                        require_once $path; 
                        $model = new Message($this->_getFirstParametre());  
                    }   
                }
                

                elseif($modelName==="FitnessTip"){
                    if($this->_getFirstParametre()){   
                        require_once $path; 
                        $model = new FitnessTip($this->_getFirstParametre());
                    }
                }


                elseif($modelName==="WorkoutPlan"){
                    if($id){
                        require_once $path;
                        $model = new WorkoutPlan($id);
                    }elseif($this->_getFirstParametre()){
                        require_once $path;    
                        $model = new WorkoutPlan($this->_getFirstParametre());
                    } 
                }*/

                
        }       
        return $model;
    }

    //returns the function part of the url
    private function _getFunction(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;  
        $url = rtrim($url, '/'); 
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/',$url);
        if(isset($url[1]))
            return $url[1];
        return NULL; 
    }


 



}


?>