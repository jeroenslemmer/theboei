<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>The Calendar</title>
		<link rel="apple-touch-icon" sizes="57x57" href="../common/css/images/icon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="../common/css/images/icon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="../common/css/images/icon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="../common/css/images/icon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="../common/css/images/icon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="../common/css/images/icon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="../common/css/images/icon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="../common/css/images/icon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="../common/css/images/icon/apple-icon-180x180.png">
		<link rel="icon" type="image../common/css/images/icon/png" sizes="192x192"  href="../common/css/images/icon/android-icon-192x192.png">
		<link rel="icon" type="image../common/css/images/icon/png" sizes="32x32" href="../common/css/images/icon/favicon-32x32.png">
		<link rel="icon" type="image../common/css/images/icon/png" sizes="96x96" href="../common/css/images/icon/favicon-96x96.png">
		<link rel="icon" type="image../common/css/images/icon/png" sizes="16x16" href="../common/css/images/icon/favicon-16x16.png">
		<link rel="manifest" href="../common/css/images/icon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="../common/css/images/icon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<link href="../common/css/fullcalendar.css" rel="stylesheet" />
		<link href="../common/css/fullcalendar.print.css" rel="stylesheet" media="print" />
		<link href="../common/css/jquery-ui.css" rel="stylesheet" />
		<link href="../common/css/style.css" rel="stylesheet" />
		<script src="../common/js/moment-with-locales.js"></script>
		<script src="../common/js/jquery.js"></script>
		<script src="../common/js/jquery-ui.js"></script>
		<script src="../common/js/fullcalendar.min.js"></script>
		<script src="../common/js/lang/nl.js"></script>
		<script>
		

	$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'title',
				right: ''
			},
			defaultView: 'agendaDay',
			//defaultDate: moment().format('YYYY-MM-DD'),
			defaultDate: '2015-05-03',
			businessHours: {start: '9:00', end: '24:00', dow: [0,5,6]},
			minTime: "09:00:00",
			maxTime: "23:00:00",
			editable: true,
			selectable: true,
			selectOverlap : false,
			unselectAuto : false,
			selectHelper: true,
			eventLimit: true, 
			eventSources: [
				'../event/getEvents.php'
			],
			viewRender: function(){
			},
			dayRender: function(date,cell){
			},
			dayClick: function(date, jsEvent, view) {
			}
		});
	});	
			</script>

	</head>
	<body>
		<div id="booking">
			<div id='calendar'></div>
		</div>

</body>
</html>
