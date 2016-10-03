<?php
require_once('../../includ/db/DataBase.php');
require_once('include/process.php');

//require '../../../include/autoloader.php';
//autoloader::register();
//spl_autoload_register();

$con = DataBase::getInstance();

$event = new process($con->getConnection());
$event->display();

?>
