<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
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
	
	<style>
		*{
			font-size : 2em;
		}
		#datestring {
			width : 100%;
		}
		#convert {
			width : 30%;
		}
		#reset {
			width : 30%;
		}
		
	</style>
	
</head>

<body>
	
	<input id="datestring" type="text" value="2015-05-03T09:00:00+02:00"><br>
	<button id="convert">convert</button>
	<button id="reset">reset</button>
	<p id="dateconverted">nothing</p>
	<P id="datenow"></p>
	<P id="moment"></p>
	<p id="retour"></p>
<script>
	$('#convert').click(function(){
		var dd = new Date($('#datestring').val());
		$('#dateconverted').html(dd);
		var now = new Date();
		$('#datenow').html(now);
		$('#moment').html(moment().format());
		$('#retour').html(moment().utc().format());
		
	});
	$('#reset').click(function(){

		$('#datestring').val('2015-05-03T09:00:00+02:00');
	});

</script>



</body>
</html>