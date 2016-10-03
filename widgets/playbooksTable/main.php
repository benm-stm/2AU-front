<?php
require ('include/process.php');

$playbook_list = new process('../../ansible/playbooks');
$pb = $playbook_list->dirToArray();
echo $playbook_list->display($pb);

?>
