<?php

class BookingController
{
	public function bookCourt($bookerID, $bookingDate, $bookingStartTime, $bookingEndTime, $sport, $courtID) {

		$bookerID = stripslashes($bookerID);
		$bookingStartTime = stripslashes($bookingStartTime);
		$bookingEndTime = stripslashes($bookingEndTime);
		$sport = stripslashes($sport);
		$courtID = stripslashes($courtID);

		$result = false;

		try {
			$bookingModel = new BookingModel();

			if (empty($bookerID) || empty($bookingDate) || empty($bookingStartTime) || empty($bookingEndTime) || empty($sport) || empty($courtID) ) {
				throw new Exception("All field are required.");
			}

			$result = $bookingModel->insertBooking($bookerID, $bookingDate, $bookingStartTime, $bookingEndTime, $sport, $courtID);
		} catch (Exception $e) {
			throw $e;
		}

		return $result;
	}

	public function getBooking($bookerID, $bookingDate, $bookingStartTime, $bookingEndTime, $sport, $courtID) {
		$bookerID = stripslashes($bookerID);
		$bookingStartTime = stripslashes($bookingStartTime);
		$bookingEndTime = stripslashes($bookingEndTime);
		$sport = stripslashes($sport);
		$courtID = stripslashes($courtID);

		$result = false;

		try {
			$bookingModel = new BookingModel();

			if (empty($bookerID) || empty($bookingDate) || empty($bookingStartTime) || empty($bookingEndTime) || empty($sport) || empty($courtID) ) {
				throw new Exception("All field are required.");
			}

			$result = $bookingModel->selectABooking($bookerID, $bookingDate, $bookingStartTime, $bookingEndTime, $sport, $courtID);
		} catch (Exception $e) {
			throw $e;
		}

		return $result;
	}
}

?>