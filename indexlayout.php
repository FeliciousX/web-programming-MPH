<!DOCTYPE html>
<html lang="en">
<head>
	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
	
	<!-- Your styles -->
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
</head>

<body>
<div class="container heading">
	<div class="row">
		<div class="twelvecol">
			<h1 class="centerText">Some Kind of Booking System</h1>
		</div>
	</div>
</div>
<?php include 'inc/navbar.php' ?>
<div class="container">
	<div class="row selection">
		<div class="twelvecol last centerObjects">
			<form name="sportsForm" action="testlayout.php" method="post">
			<p>Sports type: &nbsp;
			<select name="sportsType">
			    <option value="Basketball">Basketball</option>
			    <option value="Badminton">Badminton</option>
			    <option value="Table Tennis">Table Tennis</option>
			    <option value="Squash">Squash</option>
			    <option value="Multistorey Carpark">Multistorey Carpark (Futsal & Tennis)</option>
			</select>
			<input type="submit" value="Submit" />
			</p>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="twelvecol last">
			<?php
				echo '<table name="bookingSchedule">';
				date_default_timezone_set('Asia/Kuching');

				// Display the days
        	    $today = getdate(date('U'));
        	    $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        	    $day = $today['weekday'];

        	    echo '<tr> <td></td> <td>' . $day . '</td>';

        	    for($i = 0; $i < 7; $i++) 
        	    {
        	    	if($day == $daysOfWeek[$i]) {
        	    		if($i+1 == 7)
        	    		{
        	    			$i=-1;
        	    		}
        	    		$day = $daysOfWeek[$i+1];
        	    		if($day == $today['weekday'])
        	    		{
        	    			break;
        	    		}
        	    		else
        	    		{
        	    			echo '<td>' . $day . '</td>';
        	    		}
        	    	}
        	    }
				echo '</tr>';

				// Display the time range
				$startTimeHour = 9;
				$startTimeMinutes = 0;
				$endTimeHour = 23;
				$endTimeMinutes = 0;
				$timeHour = $startTimeHour;
				$timeMinutes = $startTimeMinutes;
				do {
					echo '<tr>';
					echo '<td>' . $timeHour . $timeMinutes . 0 . '</td>';
					$timeMinutes += 3;
					if($timeMinutes == 6)
					{
						$timeHour++;
						$timeMinutes = 0;
					}
				} while ($timeHour . $timeMinutes <= $endTimeHour . $endTimeMinutes);

				echo '</tr>';
				echo '</table>';
			?>
		</div>
	</div>
</div>

</body>

</html>