<?php

require_once 'libs/model_helper/User_Helper.php';

class Admin_Helper extends User_Helper{

function __construct(){
    parent::__construct("Admin");
}

}




?>