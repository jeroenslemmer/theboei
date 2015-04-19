<?php 
	require_once('getscenarios.model.php');
	$json = json_encode($scenarios);
	echo $json;