<?php
class process
{
private $dir;

public function __construct($path){
	$this->dir = $path;
}

public function dirToArray() { 
   
   $result = array(); 
   if ($handle = opendir($this->dir)) {
    while (false !== ($file = readdir($handle))) {
	if ($file != "." && $file != ".."){
	array_push($result, $file);
	}
    }
    closedir($handle);
    }
   
   return $result; 
}

public function display($array_data) {
	$result ="";
	foreach ($array_data as $value){
    		$result.= '<tr>
                      <td> '.$value.' </td>
                      <td> NA </td>
                      <td class="td-actions">
							<button class="btn btn-small btn-success btn-icon-only icon-ok launch_playbook"></button> 
							<button class="btn btn-small btn-danger btn-small btn-icon-only icon-remove abort_playbook"></button>
					  </td>
                  </tr>';
	}	
return $result;
}
}
?>            

