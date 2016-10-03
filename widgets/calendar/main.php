<?php
require_once('../../includ/db/DataBase.php');
require_once('include/process.php');

//require '../../../include/autoloader.php';
//autoloader::register();
//spl_autoload_register();

$type  = $_POST['type'];
$con = DataBase::getInstance();

$event = new process($_POST['id'], $_POST['title'], $_POST['start'], $_POST['end'], $_POST['instance'],$con->getConnection());

if($type == 'create')
{
 $event->create();
} elseif($type == 'update')
{
 $event->update();
} elseif($type == 'delete')
{
 $event->delete();
} else
{
 $event->select();
}
?>
