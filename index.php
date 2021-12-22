<?php

session_start();
require 'config/DatabaseConf.php';
require 'config/DirConf.php';
require 'config/NotificationConf.php';
require 'libs/App.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/database/lib_database.php';
require 'libs/interfaces/lib_interface.php';
require 'libs/mediator/MessageMediator.php';

//require "models/Coach_Model.php";
//require "models/Customer_Model.php";
//require "models/Admin_Model.php";

$app = new App();


 



?>