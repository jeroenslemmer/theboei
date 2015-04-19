<?php
	$dsn = 'mysql:dbname=theboei;host=127.0.0.1';
	$user = 'root';
	$password = '';
	$db = new PDO($dsn,$user,$password);
	$query = $db->prepare('SELECT title, start, end FROM events');
	$query->execute();
	$events = $query->fetchAll(PDO::FETCH_ASSOC);
	
	function calendarformat ($dt)
	{
		return  substr($dt,0,10) . ((!strpos($dt,' 00:00:00'))?('T'.substr($dt,0,11)):(''));
	}
	
	for ($e = 0; $e < count($events); $e++){
		$events[$e]['start'] = calendarformat($events[$e]['start']);
		$events[$e]['end'] = calendarformat($events[$e]['end']);
	}
	
	$json = json_encode($events);
	echo $json;
?>