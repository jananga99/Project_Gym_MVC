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
require 'libs/mediator/Mediator.php';
require 'libs/flyweight/lib_flyweight.php';

//require "models/Coach.php";
//require "models/Customer.php";
//require "models/Admin.php";


$app = new App();


 



?>