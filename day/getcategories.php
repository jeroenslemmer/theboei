<?php 
	require_once('getcategories.model.php');
	$json = json_encode($categories);
	echo $json;