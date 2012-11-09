<?php

/**
 * Booking Model class for Staff table
 * 
 * @author Churchill Lee
 * @version 2012-11-08
 * @package Model
 */
class BookingModel {
	private $TABLE_BOOKING = "Booking";
	private $COLUMN_BOOKINGID = "BookingID"; // INTEGER
	private $COLUMN_BOOKERID = "BookerID"; // VARCHAR
	private $COLUMN_BOOKING_DATE = "BookingDate"; // DATE
	private $COLUMN_BOOKING_START_TIME = "BookingStartTime"; // TIME
	private $COLUMN_BOOKING_END_TIME = "BookingEndTime";
	private $COLUMN_SPORT = "Sport";
	private $COLUMN_COURTID = "CourtID";

	public function createBookingTable() {
		$config = new DBConfiguration();

		$bookingTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

		if (strcmp($bookingTable->connect_error, "") != 0) {
			throw new Exception('We are currently experiencing some heavy traffic. Please try again later');
		}

		$queryStr = "CREATE TABLE $this->TABLE_BOOKING (
			$this->COLUMN_BOOKINGID INTEGER AUTO_INCREMENT NOT NULL,
			$this->COLUMN_BOOKERID VARCHAR(15) NOT NULL,
			$this->COLUMN_BOOKING_DATE DATE NOT NULL,
			$this->COLUMN_BOOKING_START_TIME DATE NOT NULL,
			$this->COLUMN_BOKING_END_TIME DATE NOT NULL,
			$this->COLUMN_SPORT VARCHAR(50) NOT NULL,
			$this->COLUMN_COURTID INTEGER NOT NULL,
			PRIMARY KEY($this->COLUMN_BOOKERID, $this->COLUMN_BOOKING_DATE));"
		$result = $bookingTable->query($queryStr);

		$bookingTable->close();

		return $result;
	}

	public function insertBooking($bookerID, $bookingDate, $bookingStartTime, $bookingEndTime, $sport, $courtID)
	{
		$config = new DBConfiguration();
		$result = false;
		$bookingTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

		if (strcmp($bookingTable->connect_error, "") != 0) {
			throw new  Exception("We are currently experiencing some heavy traffic. Please try again later");
		}

		$queryStr = "INSERT INTO $this->TABLE_BOOKING VALUES('', '$bookerID', '$bookingDate', '$bookingStartTime', '$bookingEndTime', '$sport', $courtID);";

		$result = $bookingTable->query($queryStr);
		$bookingTable->close();

		return $result;
	}

	public function selectABooking($bookerID, $bookingDate, $bookingStartTime, $bookingEndTime, $sport, $courtID)
	{
		$booking = null;
		$config = new DBConfiguration()

		$bookingTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

		if (strcmp($bookingTable->connect_error, "") != 0) {
			throw new Exception("We are currently experiencing some heavy traffic. Please try again later.");
		}

		$queryStr = "SELECT b.$this->COLUMN_BOOKINGID, b.$this->COLUMN_BOOKING_DATE, u.StudentFirstName, u.StudentLastName, b.$this->COLUMN_SPORT, b.$this->COLUMN_BOOKERID, b.$this->COLUMN_BOOKING_START_TIME, b.$this->COLUMN_BOOKING_END_TIME
					FROM $this->TABLE_BOOKING b, Student u WHERE b.$this->COLUMN_BOOKERID = $bookerID AND b.$this->COLUMN_BOOKERID = u.StudentID AND b.$this->COLUMN_BOOKING_DATE = $bookingDate AND b.$this->COLUMN_BOOKING_START_TIME = $bookingStartTime AND b.$this->COLUMN_BOOKING_END_TIME
					GROUP BY b.$this->COLUMN_BOOKERID";

		$result = $bookingTable->query($queryStr);

		if ($bookingTable->affected_rows > 0) {
			for ($i=0; $i < $result->num_rows; $i++) { 
				$row = $result->fetch_assoc();
				$booking[$i][$this->COLUMN_BOOKINGID] = $row[$this->COLUMN_BOOKINGID];
				$booking[$i][$this->COLUMN_BOOKERID] = $row[$this->COLUMN_BOOKERID];
				$booking[$i][$this->COLUMN_BOOKING_DATE] = $row[$this->COLUMN_BOOKING_DATE];
				$booking[$i][$this->COLUMN_BOOKING_START_TIME] = $row[$this->COLUMN_BOOKING_DATE];
				$booking[$i][$this->COLUMN_BOOKING_END_TIME] = $row[$this->COLUMN_BOOKING_END_TIME];
				$booking[$i][$this->COLUMN_SPORT] = $row[$this->COLUMN_SPORT];
				$booking[$i][$this->COLUMN_COURTID] = $row[$this->COLUMN_COURTID];
			}
		}

		$bookingTable->close();

		return $booking;
	}

	public function selectAllBooking() 
	{
		$booking = null;
		$config = new DBConfiguration()

		$bookingTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

		if (strcmp($bookingTable->connect_error, "") != 0) {
			throw new Exception("We are currently experiencing some heavy traffic. Please try again later.");
		}

		$queryStr = "SELECT b.$this->COLUMN_BOOKINGID, b.$this->COLUMN_BOOKING_DATE, u.StudentFirstName, u.StudentLastName, b.$this->COLUMN_BOOKERID, b.$this->COLUMN_BOOKING_START_TIME, b.$this->COLUMN_BOOKING_END_TIME FROM $this->TABLE_BOOKING b, Student u WHERE b.$this->COLUMN_BOOKERID = u.StudentID";
        
		$result = $bookingTable->query($queryStr);

		if ($bookingTable->affected_rows > 0) {
			for ($i=0; $i < $result->num_rows; $i++) { 
				$row = $result->fetch_assoc();
				$booking[$i][$this->COLUMN_BOOKINGID] = $row[$this->COLUMN_BOOKINGID];
				$booking[$i][$this->COLUMN_BOOKERID] = $row[$this->COLUMN_BOOKERID];
				$booking[$i][$this->COLUMN_BOOKING_DATE] = $row[$this->COLUMN_BOOKING_DATE];
				$booking[$i][$this->COLUMN_BOOKING_START_TIME] = $row[$this->COLUMN_BOOKING_DATE];
				$booking[$i][$this->COLUMN_BOOKING_END_TIME] = $row[$this->COLUMN_BOOKING_END_TIME];
				$booking[$i][$this->COLUMN_SPORT] = $row[$this->COLUMN_SPORT];
				$booking[$i][$this->COLUMN_COURTID] = $row[$this->COLUMN_COURTID];
			}
		}

		$bookingTable->close();

		return $booking;
	}

	public function selectTodayBooking()
	{
		$booking = null;
		$config = new DBConfiguration;

		$bookingTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($bookingTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT b.$this->COLUMN_BOOKINGID, b.$this->COLUMN_BOOKING_DATE, u.StudentFirstName, u.StudentLastName, b.$this->COLUMN_BOOKERID, b.$this->COLUMN_SPORT, b.$this->COLUMN_BOOKING_START_TIME, b.$this->COLUMN_BOOKING_END_TIME FROM $this->TABLE_BOOKING b, Student u WHERE b.$this->COLUMN_BOOKERID = u.StudentID AND b.$this->COLUMN_BOOKING_DATE = CURDATE() ORDER BY b.$this->COLUMN_BOOKING_START_TIME";
        $result = $bookingTable->query($queryStr);

        if ($bookingTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                $booking[$i][$this->COLUMN_BOOKINGID] = $row[$this->COLUMN_BOOKINGID];
                $booking[$i][$this->COLUMN_BOOKING_DATE] = $row[$this->COLUMN_BOOKING_DATE];
                $booking[$i]['StudentFirstName'] = $row['StudentFirstName'];
                $booking[$i]['StudentLastName'] = $row['StudentLastName'];
                $booking[$i][$this->COLUMN_BOOKERID] = $row[$this->COLUMN_BOOKERID];
                $booking[$i][$this->COLUMN_COURTID]
                $booking[$i][$this->COLUMN_BOOKING_START_TIME] = $row[$this->COLUMN_BOOKING_START_TIME];
                $booking[$i][$this->COLUMN_BOOKING_END_TIME] = $row[$this->COLUMN_BOOKING_END_TIME];
            }
        }

        $bookingTable->close();

        return $booking;
	}
}

?>