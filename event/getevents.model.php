<?php
	require_once "../common/db/db.php";

	function getEvents(){
		global $db;
		$query = $db->prepare('
SELECT event.title, event.start, event.end, event.id, event.client_id, event.category_id, client.name as client_name, category.title as category_title
FROM event
LEFT JOIN client ON event.client_id = client.id
LEFT JOIN category ON event.category_id = category.id
ORDER BY event.start
');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);	
	}