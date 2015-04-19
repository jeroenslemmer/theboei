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
		
		var markedDates=[];
		var categories= [];
		var scenarios = [];
		function gotCategories(data){
			categories = $.parseJSON(data);
			for (c in categories){
				//console.log(categories[c])
			}
		}
		
		function getCategories(){
			$.ajax({
				url: 'getcategories.php',
				success : gotCategories
			});
		}
		
		function gotScenarios(data){
			scenarios = $.parseJSON(data);
			for (c in scenarios){
				//console.log(scenarios[c])
				for (e in scenarios[c].events ){
					//console.log(scenarios[c].events[e].daynr + " " + scenarios[c].events[e].time)
				}
			}
		}

		function getScenarios(){
			$.ajax({
				url: 'getscenarios.php',
				success : gotScenarios
			});
		}	
		
		function inMarkedDates(datestr){
			for (d in markedDates){
				if (datestr == markedDates[d]) return parseInt(d);
			}
			return -1;
		}
		
		function toggleMarkDate(date){
			datestr = date.format()
			var marked = inMarkedDates(datestr);
			if (marked < 0){
				markedDates[markedDates.length] = datestr;
			} else {
				markedDates.splice(marked,1);
			}
		}
		
		function addSchedule(){
			// toon popup met mogelijke scenarios kies en submit
			markedDates.sort(function(a,b){return a > b;});
			for (d in markedDates){
				
				
				
			}
			
			
			var events = $('#calendar').fullCalendar('clientEvents');
			for (var e in events){
				console.log(events[e].title);
			}
			
			// request voor alle gemarkeerde data: 
		}
		
		function addScheduleButton(){
			$('.fc-right .fc-button-group').prepend('<button class="fc-button fc-state-default fc-corner-left fc-corner-right fc-state-active fc-schedule-button">schedule</button>');
			$('.fc-schedule-button').click(function(){addSchedule();});
			$('.fc-right .fc-button-group').prepend('<button class="fc-button fc-state-default fc-corner-left fc-corner-right fc-state-active fc-submit-button">confirm</button>');
		}
		
		function displayScheduleButton(){
			if (markedDates.length > 0){
				$('.fc-schedule-button').addClass('marked-dates');
			} else {
				$('.fc-schedule-button').removeClass('marked-dates');
			}
		}
		
		function styleMarkedDate(date, me){
				if (inMarkedDates(date.format())>=0){
					$(me).addClass('day-marked');
				} else {
					$(me).removeClass('day-marked');
				}
		}
		
	$(document).ready(function() {
		getCategories();
		getScenarios();
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: moment().format('YYYY-MM-DD'),
			editable: true,
			selectable: false,
			unselectAuto : false,
			selectHelper: false,
			eventLimit: true, // allow "more" link when too many events
			events:[{start: '2015-05-10T12:00:00', end: '2015-05-10T14:00:00', title : 'testje'}]
			//eventSources: [	'./getEvents.php'	],
			/*viewRender: function(){
				displayScheduleButton();
			},
			dayRender: function(date,cell){
				styleMarkedDate(date,cell);
			},
			dayClick: function(date, jsEvent, view) {
				//console.log(date.toString());
				toggleMarkDate(date);
				styleMarkedDate(date,this);
				displayScheduleButton();
			
        // change the day's background color just for fun
       //$(this).css('background-color', '#EBF8FB');
			 

    }	*/
		});
		addScheduleButton();

		function addScheduleEvents(){
			alert('add schedule events');
			
		}
		
		var dialog, form;
	  dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
          Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        //allFields.removeClass( "ui-state-error" );
      }
    });
		form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      alert('submitted');
    });
	});
		</script>
		
		<div id="schedule-form" title="Create events">
			<form>
					<label for="scenario">Scenario</label>
					<select type="text" name="scenario" id="scenario" class="text ui-widget-content ui-corner-all">
						<option value="1">Weekend</option>
						<option value="2">Feestdag</option>
						<option value="3">Avond</option>
					</select>
					<!-- Allow form submission with keyboard without duplicating the dialog button -->
					<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</form>
		</div>
		<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

		</style>
	</head>
	<body>

	<div id='calendar'></div>

</body>
</html>
