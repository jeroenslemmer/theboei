<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Timepicker</title>
		<script src="../common/js/debug.js"></script>	
		<link href="../common/css/jquery-ui.css" rel="stylesheet" />
		<script src="../common/js/jquery.js"></script>
		<script src="../common/js/jquery-ui.js"></script>
		<script src="../common/js/jquery.ui.touch-punch.js"></script>
		<script src="../common/js/moment.js"></script>
		<script src="../common/js/lang/nl.js"></script>	
		<style>
		
		
			* {
				box-sizing : border-box;
			}
			#bookday {
				border : 1px solid black;
				width : 200px;
				height : 600px;
			}
			#booking {
				width : 100%;
				padding : 5px;
				height : 100px;
				border : 1px solid black;
				background-color : #aaffaa;
			}
		
		
		</style>
		<script>
			$(function(){
				$('#booking').draggable({
					axis: "y",
					containment: "parent",
					grid: [0, 50] 
				});
				
				
				
			});
		</script>
	</head>
	
	
	<body>
		<div class="frame">
			<h1>Timepicker</h1>
			<div id="bookday">
				<div id="booking">Uw booking: Barbecueboot?
				</div>
			
			</div>
		</div>
	</body>
</html>
