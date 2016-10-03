<?php

class commandExec
{
private $descriptorspec = array(
    0 => array(
        'pipe',
        'r'
    ) ,
    1 => array(
        'pipe',
        'w'
    ) ,
    2 => array(
        'pipe',
        'w'
    )
);
private $cmd;
private $pipes = array();


public function __construct($cmd){
	$this->cmd = $cmd;
}

public function exec() {

	$process = proc_open($this->cmd, $this->descriptorspec, $this->pipes, dirname(__FILE__), null);
	if (is_resource($process)) {
    		$f = stream_get_contents($this->pipes[1]);
        	echo "-pipe 1--->";
        	var_dump($f);
    		fclose($this->pipes[1]);
    	
		$f = stream_get_contents($this->pipes[2]);
        	echo "-pipe 2--->";
        	var_dump($f);
   		fclose($this->pipes[2]);
    		proc_close($process);
}
}
}

//$cmd=new commandExec('yum install -y ansible');
//$cmd->exec();

?>
