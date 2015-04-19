<?php 
	require_once('getevents.model.php');

	
	function calendarformat ($dt){ 
		return  substr($dt,0,10) . ((!strpos($dt,' 00:00:00'))?('T'.substr($dt,11)):(''));
	}
	
	function calendarevent($event){
		$calendarevent = array();
		$calendarevent['id'] = $event['id'];
		$calendarevent['client_id'] = $event['client_id'];
		$calendarevent['client_name'] = $event['client_name'];
		$calenderevent['category_id'] = $event['category_id'];
		$calenderevent['category_title'] = $event['category_title'];
		$calendarevent['title'] = $event['title'] . ': ' . $event['client_name'];
		$calendarevent['start'] = calendarformat($event['start']);
		$calendarevent['end'] = calendarformat($event['end']);
		return $calendarevent;
	}
	
	$events = getEvents();
	$calendarevents = array();
	for ($e = 0; $e < count($events); $e++){
		$calendarevents[] = calendarevent($events[$e]);
	}
	
	$json = json_encode($calendarevents);
	echo $json;
