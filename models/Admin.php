<?php
require_once 'models/User.php';
class Admin extends User{

function __construct($email,$mediator=0){
    parent::__construct("Admin",$email,$mediator);
}

















}
?>