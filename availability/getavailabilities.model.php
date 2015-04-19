<?php
	$dsn = 'mysql:dbname=theboei;host=127.0.0.1';
	$user = 'root';
	$password = '';
	$db = new PDO($dsn,$user,$password);


	function getAvailabilities(){
		global $db;
		$query = $db->prepare('
SELECT *
FROM availability
ORDER BY start
');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);	
	}