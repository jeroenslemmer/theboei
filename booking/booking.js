	var availabilities = false;
	var events = false;
	var categories= false;
	var dayNonAvailabilities = [];
	
	function setDatePicker() {
		$( "#eventdate" ).datepicker({
			beforeShowDay : function(date){
				switch (isAvailable(date)) {
					case -1: 	return [0,'','gesloten'];
					case 1: 	return [1,'date-bookable','boekbaar'];
					case 0:		return [1,'date-full','boekbaar'];
				}
			},
			minDate : new Date(),
			defaultDate: getMinimalBookableDate()
			});
	}

	function gotEvents(data){
		events = $.parseJSON(data);
	}
	
	function getEvents(){
		$.ajax({
			url: '../event/getevents.php',
			success : gotEvents
		});
	}
	
	function gotAvailabilities(data){
		availabilities = $.parseJSON(data);
		
		for (c in availabilities){
			availabilities[c].bookable = true;
		}
	}
	
	function getAvailabilities(){
		$.ajax({
			url: '../availability/getavailabilities.php',
			success : gotAvailabilities
		});
	}
	
	function getMinimalBookableDate(){
		for (var a in availabilities){
			if  (availabilities[a].bookable) return new Date(availabilities[a].start);
		}
		return new Date();
	}
		
	function gotCategories(data){
		categories = $.parseJSON(data);
		var options = '<option value="0" title="Eerst arrangement kiezen...">te kiezen...</option>';
		for (c in categories){
			options +=
			'<option value="'+categories[c].id+'" title="'+categories[c].description+'">'+categories[c].title+'</option>';
		}
		$('select#category').html(options);
	}
	
	function getCategories(){
		$.ajax({
			url: 'getcategories.php',
			success : gotCategories
		});
	}
	
	function dateStringNoZone(dateString){
		return dateString.substr(0,19);
	}
	
	function dayString(dateString){
		return dateString.substr(0,11)+'00:00:00';
	}
	
	function dayDate(dateString){
		return new Date(dayString(dateString));
	}
	
	function getAvailabilityIndexForDay(daydate){
		for (var a in availabilities){
			var start = dayDate(availabilities[a].start);
			if (start.getTime() == daydate.getTime()){
				return a;
			}
		}
		return -1;
	}
	
	function addMinutes(date, minutes) {
			return new Date(date.getTime() + minutes*60000);
	}
	
	function calcMinutesBetween(date1, date2){
		return Math.abs(date2.getTime() - date1.getTime())/60000;
	}
	
	function createNonAvailability(start, end, title, className){
		return {start: start, end: end, title : title, editable: false, className: className};
	}
	
	function getDayNonAvailabilities(daydate, categoryId){
		var newDayNonAvailability;
		var category = categories[getCategoryIndexForId(categoryId)];
		var resultDayNonAvailabilities = [];
		var idx = getAvailabilityIndexForDay(daydate);
		if (idx > -1){
			
			
				for (var e in events){
					if (dayString(events[e].start) == dayString(availabilities[idx].start)) {
						var start = events[e].start;
						if (start> availabilities[idx].start)
							start = dateStringNoZone(moment(addMinutes(new Date(start),-category.cleanup)).format());
						resultDayNonAvailabilities[resultDayNonAvailabilities.length] = 
							createNonAvailability(start, events[e].end, 'reeds geboekt', 'event-already-booked');
					}
				}
			AvailabilityStart = availabilities[idx].start;
			for (var n in resultDayNonAvailabilities){
				if (AvailabilityStart < resultDayNonAvailabilities[n].start &&
						calcMinutesBetween(new Date(resultDayNonAvailabilities[n].start), new Date(AvailabilityStart)) < category.min_duration){
					resultDayNonAvailabilities[resultDayNonAvailabilities.length] = 
						createNonAvailability(AvailabilityStart, resultDayNonAvailabilities[n].start, 'duur te kort voor '+category.title + '\n min.'+category.min_duration+' minuten', 'event-too-small' );
				}
				AvailabilityStart = resultDayNonAvailabilities[n].end;
			}
			if (AvailabilityStart  < availabilities[idx].end &&
					calcMinutesBetween(new Date(availabilities[idx].end), new Date(AvailabilityStart)) < category.min_duration){
					newDayNonAvailability =	
					{start: AvailabilityStart, end: availabilities[idx].end, title : 'duur te kort voor '+category.title, editable: false, className: 'event-too-small'};
					resultDayNonAvailabilities[resultDayNonAvailabilities.length] = 
						createNonAvailability(AvailabilityStart, availabilities[idx].end, 'duur te kort voor '+category.title + '\nmin.'+category.min_duration+' minuten', 'event-too-small' );			
			}
		}
		function compareAvailabilities(a1,a2){
			if (a1.start > a2.start) return 1;
			if (a1.start < a2.start) return -1;
			return 0;
		}
		resultDayNonAvailabilities.sort(compareAvailabilities);
		return resultDayNonAvailabilities;
	}
	
	function inputDateToDate(input){ // dd-mm-yyyy
		return new Date(input.substr(6,4)+'-'+input.substr(3,2)+'-'+input.substr(0,2)+'T00:00:00');
	}
	
	function matchedDay(startdate,enddate, daydate){
		return (daydate >= dayDate(startdate) && daydate <= dayDate(enddate));
	}
	
	function isAvailable(d){
		for (var e in availabilities){
			if (matchedDay(availabilities[e].start, availabilities[e].end, d)) {
				if (availabilities[e].bookable)
					return 1;
				else
					return 0;
			} 
		}
		return -1;
	}
	
	function minutesBetween(start,end){
		var startDate =  new Date(start);
		var endDate = new Date(end);
		var startMsec = startDate.getTime();
		var endMsec = endDate.getTime();
		return Math.round((endMsec - startMsec) / 60000);
	}
	
	function getCategoryIndexForId(categoryId){
		for (var c in categories){
			if (categories[c].id == categoryId )	return c;
		}
		return -1;
	}
	
	function isThereRoomForEvent(roomStart, roomEnd, categoryId){
		var room = minutesBetween(roomStart,roomEnd);
		return room >= (parseInt(categories[getCategoryIndexForId(categoryId)].min_duration)+parseInt(categories[getCategoryIndexForId(categoryId)].cleanup));
	}
	
	function availabilityHasRoom(availability, categoryId){
		var hasRoom = false;
		var roomStart = availability.start;
		for (var e in events){
			if (events[e].start < availability.end && events[e].end > availability.start){
				if (events[e].start > roomStart){
					if (isThereRoomForEvent(roomStart,events[e].start,categoryId)){
						hasRoom = true;
					}
				}
				roomStart = events[e].end;
			}
		}
		if (availability.end > roomStart && 
				isThereRoomForEvent(roomStart,moment(addMinutes(new Date(availability.end),categories[getCategoryIndexForId(categoryId)].cleanup)).format(),categoryId)){
			hasRoom = true;
		}
		return hasRoom;
	}
	
	function getBookableAvailabilities(categoryId){
		for (var a in availabilities){
			availabilities[a].bookable = availabilityHasRoom(availabilities[a], categoryId);
		}
	}
	
	function getFirstRoomOnDay(day){
		var idx = getAvailabilityIndexForDay(day);
		room = {start : availabilities[idx].start, end : false};
		for (var n in dayNonAvailabilities){
			if (room.start < dayNonAvailabilities[n].start) 
			{
				room.end = dayNonAvailabilities[n].start;
				return room;
			}
			room.start = dayNonAvailabilities[n].end;
		}
		room.end = availabilities[idx].end;
		return room;
	}
	
	function getTimeFromDateString(dateString){
		return dateString.substr(14,5);
	}
	
	function updateBookingStartEnd(event){
		$('#eventstart').val(moment(event.start).format('HH:mm'));
		$('#eventend').val(moment(event.end).format('HH:mm'));
		//$('#calendar').fullCalendar('updateEvent', bookEvent);
	}
	
	bookEvents = [{start: '2000-05-08T14:00:00', end: '2000-05-08T18:00:00', title: 'book this', editable: true, overlap: false, id: 'bookevent'}];
	function setBookEvent(room){
		console.log('setBookEvent');
		var bookEvent = $('#calendar').fullCalendar('clientEvents', 'bookevent')[0];
		bookEvent.category = categories[getCategoryIndexForId($('#category').val())];
		bookEvent.room = room;
		bookEvent.start = room.start;
		bookEvent.end = dateStringNoZone(moment(addMinutes(new Date(room.start),bookEvent.category.min_duration)).format());
		bookEvent.title = 'Uw boeking: '+bookEvent.category.title + '?';
		updateBookingStartEnd(bookEvent);
		$('#calendar').fullCalendar('updateEvent', bookEvent);
	}
	
	function bookToMaxDuration(){
		var bookEvent = $('#calendar').fullCalendar('clientEvents', 'bookevent')[0];
		bookEvent.end = moment(addMinutes(new Date(bookEvent.start),bookEvent.category.max_duration)).utc().format();
		updateBookingStartEnd(bookEvent);
		$('#calendar').fullCalendar('updateEvent', bookEvent);
	}
	
	function bookToMinDuration(){
		// expand
		var bookEvent = $('#calendar').fullCalendar('clientEvents', 'bookevent')[0];
		bookEvent.end = moment(addMinutes(new Date(bookEvent.start),bookEvent.category.min_duration)).utc().format();
		updateBookingStartEnd(bookEvent);
		$('#calendar').fullCalendar('updateEvent', bookEvent);		
	}
	
	function bookResize( event, delta, revertFunc, jsEvent, ui, view ) { 
		var corrected = false
		var duration = calcMinutesBetween(new Date(event.start.format()), new Date(event.end.format()));
		var correctionTooLarge = duration - event.category.max_duration;
		if (correctionTooLarge > 0){
			setTimeout(bookToMaxDuration,50);
			return;
		}
		var correctionTooSmall = event.category.min_duration - duration;
		if (correctionTooSmall > 0){
			setTimeout(bookToMinDuration,50);
			return;
		}
		updateBookingStartEnd(event);
	}
	
		function bookDrop(event,dayDelta,minuteDelta,allDay,revertFunc) { 
			updateBookingStartEnd(event);
		}
	
	timePickerOptions = {
			header: false,
			defaultView: 'agendaDay',
			defaultDate: new Date(),
			minTime: "09:00:00",
			maxTime: "23:00:00",
			editable: true,
			selectable: false,
			selectOverlap : false,
			unselectAuto : false,
			selectHelper: false,
			eventLimit: true,
			eventResize : bookResize,
			eventDrop : bookDrop,
			eventBackgroundColor : '#66dd66',
			dayClick: function(date, jsEvent, view){console.log(date);},
			eventTextColor : 'black',
			eventSources : [
				function(start, end, timezone, callback){ callback(dayNonAvailabilities);},	
				function(start, end, timezone, callback){ callback(bookEvents);},	
			]	
	}

	function setTimePicker(day){
		try {
			$('#calendar').fullCalendar('destroy');
		} catch(e) {
			console.log('did not exist');
		}
		$('.fc-time-grid-event').resize(function(){console.log('resize');})
		var idx = getAvailabilityIndexForDay(day);
		timePickerOptions.minTime = availabilities[idx].start;
		timePickerOptions.maxTime = availabilities[idx].end;
		timePickerOptions.defaultDate = day;
		$('#calendar').fullCalendar(timePickerOptions);
		var room = getFirstRoomOnDay(day);
		setBookEvent(room);
	}
	
  $(function() {
		getAvailabilities();
		getCategories();
		getEvents();
		//setDayCalendar(new Date());
		$('#eventdate').prop('disabled',true);
		$('#eventtime').prop('disabled',true);
		$('#eventduration').prop('disabled',true);
		$('#category').change(
			function(){
				var categoryId = parseInt($(this).val());
				$('#eventdate').prop('disabled',categoryId == 0);
				if (categoryId != 0)
				{
					getBookableAvailabilities(categoryId);
					setDatePicker();
				}
			}
		);
		$('#eventdate').change(
			function(){
				var eventdate = $('#eventdate').val();
				if (eventdate > ''){
					$('#eventtime').prop('disabled',false);
					$('#eventduration').prop('disabled',false);
					var categoryId = parseInt($('#category').val());
					if (categoryId != 0) {
						var day = inputDateToDate(eventdate);
						dayNonAvailabilities = getDayNonAvailabilities(day, categoryId);
						setTimePicker(day);
					} else {
						$('#eventtime').prop('disabled',true);
						$('#eventduration').prop('disabled',true);
					}
				}	
			}
		);
   });
