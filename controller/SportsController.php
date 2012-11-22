<?php
require_once('controller/BookingController.php');


class SportsController {
	function validateSportsType($sportsType, $day, $timeHour, &$roomStatus, &$availability, $fullDate, $fullTime, $fullAfter) {
		if($sportsType=="Basketball") {
			$availability = $this->validateBasketball($day, $timeHour);
			$roomStatus = $this->checkRoomStatus($fullDate, $fullTime, $fullAfter, $sportsType);
		}
		else if($sportsType=="Badminton") {
			$availability = $this->validateBadminton($day, $timeHour);
			$roomStatus = $this->checkRoomStatus($fullDate, $fullTime, $fullAfter, $sportsType);
		}
		else if($sportsType=="TableTennis") {
			$availability = $this->validateTableTennis($day, $timeHour);
			$roomStatus = $this->checkRoomStatus($fullDate, $fullTime, $fullAfter, $sportsType);
		}
		else if($sportsType=="Squash") {
			$availability = $this->validateSquash($day, $timeHour);
			$roomStatus = $this->checkRoomStatus($fullDate, $fullTime, $fullAfter, $sportsType);
		}
		else if($sportsType=="MultistoreyCarpark") {
			$availability = $this->validateMultistoreyCarpark($day, $timeHour);
			$roomStatus = $this->checkRoomStatus($fullDate, $fullTime, $fullAfter, $sportsType);
		}
	}

	function validateBasketball($day, $timeHour) {
		if($day=="Wednesday" || $day=="Sunday")
		{
			if($timeHour>=9 && $timeHour<=23)
				return true;
			else
				return false;
		}
		else if($day=="Saturday")
		{
			if($timeHour>=16 && $timeHour<=23)
				return true;
			else
				return false;
		}
		return false;
	}

	function validateBadminton($day, $timeHour) {
		if($day=="Monday" || $day=="Tuesday" || $day=="Thursday" || $day=="Friday" || $day=="Sunday")
		{
			if($timeHour>=9 && $timeHour<=23)
				return true;
			else
				return false;
		}
		else if($day=="Saturday")
		{
			if($timeHour>=9 && $timeHour<=15)
				return true;
			else
				return false;
		}

		return false;

	}

	function validateTableTennis($day, $timeHour) {
		if($day=="Monday" || $day=="Tuesday" || $day=="Wednesday" || $day=="Thursday" || $day=="Friday")
		{
			if($timeHour>=9 && $timeHour<=23)
				return true;
			else
				return false;
		}
		else if($day=="Saturday" || $day=="Sunday")
		{
			if($timeHour>=9 && $timeHour<=22)
				return true;
			else
				return false;
		}
		return false;
	}

	function validateSquash($day, $timeHour) {
		if($day=="Monday" || $day=="Tuesday" || $day=="Wednesday" || $day=="Thursday" || $day=="Friday" || $day=="Saturday" || $day=="Sunday" )
		{
			if($timeHour>=9 && $timeHour<=23)
				return true;
			else
				return false;
		}
		return false;
	}

	function validateMultistoreyCarpark($day, $timeHour) {
		if($day=="Monday" || $day=="Tuesday" || $day=="Wednesday" || $day=="Thursday" || $day=="Friday")
		{
			if($timeHour>=8 && $timeHour<=23)
				return true;
			else
				return false;
		}
		else if($day=="Saturday" || $day=="Sunday")
		{
			if($timeHour>=9 && $timeHour<=22)
				return true;
			else
				return false;
		}
		else
		{
			if($timeHour>=16 && $timeHour<=21)
				return true;
			else
				return false;
		}
		return false;
	}

	function checkRoomStatus($fullDate, $fullTime, $fullAfter, $sportsType) {
		$bookingController = new BookingController();
		//$totalCourt=0;

		if($sportsType=="Badminton"||$sportsType=="Basketball")
		{
			if($bookingController->getBooking($fullDate, $fullTime, $fullAfter, 5) || ($bookingController->getBooking($fullDate, $fullTime, $fullAfter, 1)&&$bookingController->getBooking($fullDate, $fullTime, $fullAfter, 2)&&$bookingController->getBooking($fullDate, $fullTime, $fullAfter, 3)&&$bookingController->getBooking($fullDate, $fullTime, $fullAfter, 4)) || ($bookingController->getBooking($fullDate, $fullTime, $fullAfter, 6) && $bookingController->getBooking($fullDate, $fullTime, $fullAfter, 7)) )
				return false;
		}

		else if($sportsType=="TableTennis"||$sportsType=="Squash")
		{
			if( ($bookingController->getBooking($fullDate, $fullTime, $fullAfter, 8) && $bookingController->getBooking($fullDate, $fullTime, $fullAfter, 9)) )
				return false;
		}

		else if($sportsType=="MultistoreyCarpark")
		{
			if($bookingController->getBooking($fullDate, $fullTime, $fullAfter, 10))
				return false;
		}

		return true;
	}
}
?>