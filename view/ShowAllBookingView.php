<?php

require_once('controller/BookingController.php');


class ShowAllBookingView {
	public function showAllBooking() {
		try{
		$bookingController = new BookingController();
	    $result = $bookingController->getAllBooking();

	    if (!$result) {
	        echo '<p>No reservations found!</p>';
	        return;
	    }

	    echo '<table>';
	    echo '<thead><tr><th>Booker ID</th><th>Date</th><th>Start Time</th><th>End Time</th><th>Sport</th><th>CourtID</th></tr></thead>';
	    echo '<tbody>';
	    for ($i = sizeof($result)-1; $i >= 0; $i--) {
	        echo '<tr>';
	        echo '<form method="post" action="showallbooking.php">';
	        echo '<td><input type="text" readonly="readonly" name="bookerID" value="' . $result[$i]['BookerID'] . '" /></td>';
	        echo '<td><input type="text" readonly="readonly" name="bookingdate" value="' . $result[$i]['BookingDate'] . '"/></td>';
	        echo '<td>' . $result[$i]['BookingStartTime'] . '</td>';
	        echo '<td>' . $result[$i]['BookingEndTime'] . '</td>';
	        echo '<td>' . $result[$i]['Sport'] . '</td>';
	        echo '<td>' . $result[$i]['CourtID'] . '</td>';
	        echo '<td><input type="submit" name="cancel" value="Cancel" /></td>';
	        echo '</form>';
	        echo '</tr>';
	    }
	    echo '</tbody>';
	    echo '</table>';
		} catch (Exception $e) {
		    echo '<p style="color:red;">' . $e->getMessage() . '</p>';
		}
	}

	public function cancelBooking() {
        if (isset($_POST['cancel'])) {
            try {
                $bookingController = new BookingController();
                $bookingController->deleteBooking($_POST['bookerID'], $_POST['bookingdate']);
                
                echo '<p style="color:green;">Cancellation successful.</p>';
            } catch (Exception $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
        }
    }

}
?>