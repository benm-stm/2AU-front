<?php

class process {

private $bdd;
public function __construct($bdd)
{
	$this->bdd = $bdd;
}

public function display() {
	$current_date = date ("Y-m-d");

		// liste des événements
        $json = array();
        // requête qui récupère les événements
        $result = $this->bdd->query("SELECT * FROM evenement WHERE ( start >= '".$current_date."') ORDER BY start ASC LIMIT 3");
        // envoi du résultat au success
	if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$time  = strtotime($row['start']);
		$day   = date('d',$time);
		$month = date('m',$time);
		$year  = date('Y',$time);

		$time = mktime(0, 0, 0, $month);
		$name = strftime("%b", $time);
                $res.= '<li style="list-style-type: none;">
                  <div class="news-item-date"> <span class="news-item-day">'.$day.'</span> <span class="news-item-month">'.$name.'</span> </div>      
                  <div class="news-item-detail">
                    <h3><font color="#2398FF">'.$row['title'].'</font></h3>
                    <p>Targetted instance <b>'.$row['instance'].'</b></p>
                  </div>
                </li>';
    }
    $result->free();
	echo $res;
}
}

}

?>
