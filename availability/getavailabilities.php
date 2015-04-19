<?php 
	require_once('getavailabilities.model.php');

	
	function calendarformat ($dt){ 
		return  substr($dt,0,10) . ((!strpos($dt,' 00:00:00'))?('T'.substr($dt,11)):(''));
	}
	
	function bookingavailability($availability){
		$bookingavailability = array();
		$bookingavailability['start'] = calendarformat($availability['start']);
		$bookingavailability['end'] = calendarformat($availability['end']);
		return $bookingavailability;
	}
	
	$availabilities = getAvailabilities();
	$bookingavailabilities = array();
	for ($a = 0; $a < count($availabilities); $a++){
		$bookingavailabilities[] = bookingavailability($availabilities[$a]);
	}
	
	$json = json_encode($bookingavailabilities);
	echo $json;
