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
<div class="container">
	<div class="row">
		<div class="twelvecol">
			<h1 class="centerText">Some Kind of Booking System</h1>
		</div>
	</div>
</div>
<hr />
<div class="container">
	<div class="row">
		<div class="eightcol">
			<div class="twocol">
				<a href="btn1.html">Button 1</a>
			</div>
			<div class="twocol">
				<a href="btn2.html">Button 2</a>
			</div>
			<div class="twocol">
				<a href="btn3.html">Button 3</a>
			</div>
			<div class="twocol last">
				<a href="btn4.html">Button 4</a>
			</div>
		</div>
		<div class="fourcol last">
			<form method="post" action="testlayout.html">
			<div class="row">
				<p><label for="id">Student ID:</label><input class="text" type="text" name="id" /></p>
			</div>
			<div class="row">
				<p><label for="pw">Password:</label><input class="text" type="password" name="pw" /></p>
			</div>
			<div class="row topmargin5px">
				<div class="threecol">
					<a href="lostPassword.php">Forgot your password?</a> <br />
					<a href="register.php">Register</a>
				</div>
				<div class="twocol last">
					<input class="submit" type="submit" value="SUBMIT"/>
				</div>
			</div>
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