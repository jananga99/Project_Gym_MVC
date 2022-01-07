<?php

session_start();
require_once 'config/DatabaseConf.php';
require_once 'config/DirConf.php';
require_once 'config/NotificationConf.php';
require_once 'config/PaymentConf.php';
require_once 'config/MessageConf.php';
require_once 'libs/App.php';
require_once 'libs/Controller.php';
require_once 'libs/Model.php';
require_once 'libs/View.php';
require_once 'libs/database/lib_database.php';
require_once 'libs/interfaces/lib_interface.php';
require_once 'libs/mediator/Mediator.php';
require_once 'libs/flyweight/lib_flyweight.php';

require_once 'libs/model_helper/Helper.php';
require_once 'libs/model_helper/User_Helper.php';
require_once 'libs/model_helper/Customer_Helper.php';
require_once 'libs/model_helper/Coach_Helper.php';
require_once 'libs/model_helper/Session_Helper.php';
require_once 'libs/model_helper/Notification_Helper.php';
require_once 'libs/model_helper/Payment_Helper.php';
require_once 'libs/model_helper/Coach_Registration_Helper.php';
require_once 'libs/model_helper/WorkoutPlan_Helper.php';
require_once 'libs/model_helper/FitnessTip_Helper.php';
require_once 'libs/model_helper/Message_Helper.php';
require_once 'libs/model_helper/MessageMediator.php';


//require_once "models/Coach.php";
//require_once "models/Customer.php";
//require_once "models/Admin.php";


$app = new App();
