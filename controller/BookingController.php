<?php

/**
 * BookingController
 * 
 * @author Churchill Lee
 * @version 07-11-2012
 * @package controller
 */

class BookingController
{
	public function bookCourt($bookerID, $court, $bookStartTime, $bookEndTime) {

		try {
			$bookingModel = new BookingModel();
			$bookingModel->insertBooking($bookerID, $bookDate, $bookStartTime, $bookEndTime);
		} catch (Exception $e) {
			throw $e;
		}
	}
}

?>