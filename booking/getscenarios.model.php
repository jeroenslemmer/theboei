<?php
	$dsn = 'mysql:dbname=theboei;host=127.0.0.1';
	$user = 'root';
	$password = '';
	$db = new PDO($dsn,$user,$password);
	$query = $db->prepare('
SELECT * 
FROM scenario
');
	$query->execute();
	$scenarios = $query->fetchAll(PDO::FETCH_ASSOC);
	
	function getScenarioEvents($id){
		global $db;
		$query = $db->prepare('
SELECT * 
FROM scenario_event
WHERE id = :id
ORDER BY daynr, time
');
		$query->execute(array(':id'=>$id));
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	for ($s = 0; $s < count($scenarios); $s++){
		$scenarios[$s]['events'] = getScenarioEvents($scenarios[$s]['id']);
	}
