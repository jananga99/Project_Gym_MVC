<?php

class Auth extends Model{

function __construct($data=-1){
    parent::__construct();
}


//Cheks whther a user exists as in login credentials
function validateLogIn($email,$password){
    return $this->helper_factory->getHelper("Auth")->validateLogIn($email,$password);
}




}





?>