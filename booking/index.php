<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Boei boeken</title>
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
		<script src="../common/js/jquery.ui.touch-punch.js"></script>
		<script src="../common/js/moment.js"></script>
		<script src="../common/js/fullcalendar.js"></script>
		
		<script src="../common/js/lang/nl.js"></script>	
		<script src="booking.js"></script>
	</head>
	<body>
		<div class="frame">
			<div id="booking">
				<h1>Dobber op The Boei</h1>
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
						<label for="eventstart">Afvaart:</label>
						<input type="text" id="eventstart" name="eventstart" readonly="readonly" disabled>					
					</div>
					<div>
						<label for="eventend">Terug:</label>
						<input type="text" id="eventend" name="eventend" readonly="readonly" disabled>					
					</div>
					<div>
						<label id="nrpersons-label">Aantal personen:</label>
						<div id="nrpersons">
							<input type="radio" id="nrpersons4" name="nrpersons" value="4" checked><label for="nrpersons4">4</label>
							<input type="radio" id="nrpersons5" name="nrpersons" value="5" ><label for="nrpersons5">5</label>
							<input type="radio" id="nrpersons6" name="nrpersons" value="6"><label for="nrpersons6">6</label>
							<input type="radio" id="nrpersons7" name="nrpersons" value="7"><label for="nrpersons7">7</label>
							<input type="radio" id="nrpersons8" name="nrpersons" value="8"><label for="nrpersons8">8</label>
						</div>
					</div>
					<div>
						<label for="eventremarks">Opmerkingen</label>
						<div>
							<textarea id="eventremarks" name="eventremarks"></textarea>
						</div>
					</div>
					<div id='calendar'></div>
					<div>
						<input type="submit" name="submit" value="naar boeken">
					</div>	
				</form>
			</div>
		</div>
	</body>
</html>
