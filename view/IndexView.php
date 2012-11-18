<?php

class IndexView {

	public function displayTable() {
		echo '<table name="bookingSchedule">';
		date_default_timezone_set('Asia/Kuching');
	
		// Display the days
	    $today = getdate(date('U'));
	    $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	    $day = $today['weekday'];
	
	    echo '<tr> <td></td> <td>' . $day . '</td>';

		$j = 0;
	    for($i = 0; $i < 7; $i++) 
	    {
	    	if($day == $daysOfWeek[$i]) {
	    		if($i+1 == 7)
	    		{
	    			$i=-1;
	    		}
	    		$day = $daysOfWeek[$i+1];

	    		if($i==-1)
	    		{
	    			$realWeek[$j] = $daysOfWeek[6];
	    		}
	    		else
	    		{
	    			$realWeek[$j] = $daysOfWeek[$i];
	    		}

				$j++;
				
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
		$endTimeHour = 23;
		$endTimeMinutes = 0;
		$timeHour = 9;
		$timeMinutes = 0;
		do {
			echo '<tr>';
			echo '<td>' . $timeHour . $timeMinutes . 0 . '</td> ';
			for($j = 0; $j < 7; $j++)
			{
				if ($timeHour . $timeMinutes . 0) {
					echo '<td><form name="bookingForm" method="post" action="bookingpage.php"><input name="timeinfo" type = "hidden" value = ' .  $timeHour . $timeMinutes . 0 . ' /><input name="dayinfo" type = "hidden" value = ' .  $realWeek[$j] . ' /><button class="btnAvailable" type="submit"  /></form></td>';
				}
			}

			echo '</tr>';
			$timeMinutes += 3;
			if($timeMinutes == 6)
			{
				$timeHour++;
				$timeMinutes = 0;
			}
		} while ($timeHour . $timeMinutes <= $endTimeHour . $endTimeMinutes);
	
		echo '</table>';
	}

}

?>