<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Book a Boot</title>
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
		<script src="../common/js/debug.js"></script>	
		<link href="../common/css/jquery-ui.css" rel="stylesheet" />
		<link href="../common/css/style.css" rel="stylesheet" />
		<script src="../common/js/jquery.js"></script>
		<script src="../common/js/jquery-ui.js"></script>
		<script src="../common/js/moment.js"></script>
		<script src="../common/js/fullcalendar.js"></script>
		<script src="../common/js/lang/nl.js"></script>	
		<script src="booking.js"></script>
	</head>
	<body>
		<div class="frame">
			<div id="booking">
				<form>
					<div>
						<label for="category">Arrangement:</label>
						<select id="category" name="category">
						</select>
					</div>
					<div >
						<label for="eventdate">Datum:</label>
						<input type="text" id="eventdate" name="eventdate" readonly="readonly">
					</div>
					<div>
						<label for="eventstart">Aanvang:</label>
						<input type="text" id="eventstart" name="eventstart" readonly="readonly" disabled>					
					</div>
					<div>
						<label for="eventend">Einde:</label>
						<input type="text" id="eventend" name="eventend" readonly="readonly" disabled>					
					</div>
					<div>
						<label for="personen">Personen:</label>
						<span id="personen">
							<input type="radio" name="personen" value="4" checked><label>4</label>
							<input type="radio" name="personen" value="5" ><label>5</label>
							<input type="radio" name="personen" value="6" ><label>6</label>
							<input type="radio" name="personen" value="7" ><label>7</label>
							<input type="radio" name="personen" value="8" ><label>8</label>
						</span>					
					</div>
					<div>
						<label for="eventremarks">Text</label>
						<div>
							<textarea id="eventremarks" name="eventremarks"></textarea>
						</div>
					</div>
					<div>
						<input type="submit" name="submit" value="boeken">
					</div>						
				</form>
				<div id='calendar'></div>
			</div>
		</div>
</body>
</html>
