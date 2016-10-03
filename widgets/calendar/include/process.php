<?php

class process {

private $title;
private $start;
private $end;
private $bdd;
private $id;
private $instance;

public function __construct($id, $title, $start, $end, $instance, $bdd)
{
$this->title = $title;
$this->start = $start;
$this->end = $end;
$this->bdd = $bdd;
$this->id = $id;
$this->instance = $instance;
}
public function create()
{
	$this->bdd->query("INSERT INTO evenement (title, start, end, instance) VALUES ('".$this->title."','". $this->start."','". $this->end."','". $this->instance."')");
}
public function update()
{
	$this->bdd->query("UPDATE evenement SET title='".$this->title."', start='".$this->start."', end='".$this->end."', instance='".$this->instance."' WHERE id=".$this->id);
}

public function delete()
{
	$this->bdd->query("DELETE FROM evenement WHERE id=".$this->id);
}

public function select()
{
// liste des événements
        $json = array();
        // requête qui récupère les événements
        $result = $this->bdd->query("SELECT * FROM evenement ORDER BY id");
        // envoi du résultat au success
        while($array = $result->fetch_assoc()) {
    $json []= $array;
        }
        echo json_encode($json);
}

}

?>
