<?php
	$dsn = 'mysql:dbname=theboei;host=127.0.0.1';
	$user = 'root';
	$password = '';
	$db = new PDO($dsn,$user,$password);
	$query = $db->prepare('
SELECT * 
FROM category
');
	$query->execute();
	$categories = $query->fetchAll(PDO::FETCH_ASSOC);
