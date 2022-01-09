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
require_once 'libs/validator/validator.php';
require_once 'libs/database/lib_database.php';
require_once 'libs/interfaces/lib_interface.php';
require_once 'libs/mediator/Mediator.php';
require_once 'libs/mediator/MessageMediator.php';
require_once 'libs/flyweight/lib_flyweight.php';

require_once 'libs/model_helper/Helper_Factory.php';
require_once 'libs/model_helper/Helper.php';


$app = new App();

?>