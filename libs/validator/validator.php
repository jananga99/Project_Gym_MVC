<?php

class Validator{


//Only alphabets and whitespaces are allowed.
//Returns TRUE if validate, FALSE otherwise
function validateName($name){    
    if(preg_match ("/^[a-zA-z]*$/", $name))
        return TRUE;
    else
        return FALSE;
}








}




?>