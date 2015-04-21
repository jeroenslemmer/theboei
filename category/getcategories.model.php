<?php
	require_once "../common/db/db.php";

	$query = $db->prepare('
SELECT * 
FROM category
');
	$query->execute();
	$categories = $query->fetchAll(PDO::FETCH_ASSOC);
