<?php
	require_once "../common/db/db.php";

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