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

function validateAge($age){
    if(preg_match("/^[0-9]*$/", $age))
        return TRUE;
    else
        return FALSE;
}

function validateCiTY($city){
    if(preg_match("/^[a-z]*$/i", $city))
        return TRUE;
    else
        return FALSE;
}

function validateEmail($email){
    if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", $email))
        return TRUE;
    else
        return FALSE;
}

function validateCardNumber($cardNumber){
    if(preg_match("/^[0-9]*$/", $cardNumber))
        return TRUE;
    else
        return FALSE;
}

function validateExpiry($expiry){
    if(preg_match("/^[0-9]{1,2}\/[0-9]{4}$/", $expiry))
        return TRUE;
    else
        return FALSE;
}

function validateCVC($cvc){
    if(preg_match("/^[0-9]{3}$/i", $cvc))
        return TRUE;
    else
        return FALSE;
}

function validateTime($time){
    if(preg_match("/^(0?[1-9]|1[0-2]):([0-5]\d)\s?((?:A|P)\.?M\.?)$/i", $time))
        return TRUE;
    else
        return FALSE;
}

function validateDate($date){
    if(preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/", $date))
        return TRUE;
    else
        return FALSE;
}

}
?>