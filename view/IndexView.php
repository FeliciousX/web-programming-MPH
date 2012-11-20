<?php
require_once('controller/SessionManager.php');

class IndexView {

	public function displayTable() {
		echo '<table name="bookingSchedule">';
		date_default_timezone_set('Asia/Kuching');
	
		$sessionManager = new SessionManager();

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
			$dateDay = $today['mday'];
			$dateMonth = $today['mon'];
	    	$dateYear = $today['year'];
			if($sessionManager->authenticateSession()) {
				$dateDay--; //Must minus here, because first time it enters, dateDay adds 1.
				for($j = 0; $j < 7; $j++)
				{
					//Query here - model
					$dateDay++; //dateDay adds 1 here.
					if($dateMonth==1 || $dateMonth==3 || $dateMonth == 5 || $dateMonth == 7 || $dateMonth == 10 || $dateMonth == 12) {
						if($dateDay >= 32)
						{
							$dateDay = 1;
							$dateMonth++;
						}
					}
					else if($dateMonth==2) {
						if(date('L', strtotime("$dateYear-01-01"))) //checks for leap year
							if($dateDay >= 30)
							{
								$dateDay = 1;
								$dateMonth++;
							}
						else
							if($dateDay >= 29)
							{
								$dateDay = 1;
								$dateMonth++;
							}
					}
					else {
						if($dateDay >= 31)
						{
							$dateDay = 1;
							$dateMonth++;
						}
					}

					if($dateMonth>=13)
					{
						$dateMonth = 1;
						$dateYear++;
					}

					if ($timeHour . $timeMinutes . 0) {
						echo '<td>
								<form name="bookingForm" method="post" action="bookingpage.php">
									<input name="dateday" type="hidden" value = "' . $dateDay . '"/> 
									<input name="datemonth" type="hidden" value = "' . $dateMonth . '"/> 
									<input name="dateyear" type="hidden" value = "' . $dateYear . '"/> 
									<input name="timeinfo" type = "hidden" value = "' .  $timeHour . $timeMinutes . 0 . '" />
									<input name="dayinfo" type = "hidden" value = "' .  $realWeek[$j] . '" />
									<button class="btnAvailable" type="submit">Available</button>
								</form>
							 </td>';
					}
					else if(!$timeHour) {
						echo '<td><button class="btnUnavailable" type="submit">Booked</button></td>';
					}
					else {
						echo '<td class=grey>Unavailable</td>';
					}
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