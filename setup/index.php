<?php

require_once('../config.php');
require_once('../model/AdminModel.php');
require_once('../model/BlacklistModel.php');
require_once('../model/DaySlotModel.php');
require_once('../model/HolidayModel.php');
require_once('../model/ParticipantModel.php');
require_once('../model/ReservationModel.php');
require_once('../model/RoomModel.php');
require_once('../model/TimeSlotModel.php');
require_once('../model/TimeTableSlotModel.php');
require_once('../model/UserModel.php');

/**
 * Create Database into MySQL Server
 * 
 * @author Benedict Khoo
 * @version 2012-06-13
 */
class DBInstaller {

    private function setupAdminTable() {
        $result = FALSE;

        try {
            $adminModel = new AdminModel();

            $result = $adminModel->createAdminTable();
            echo '<p>Admin Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupBlacklistTable() {
        $result = FALSE;

        try {
            $blacklistModel = new BlacklistModel();

            $result = $blacklistModel->createBlacklistTable();
            echo 'Blacklist Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupDaySlotTable() {
        $result = FALSE;

        try {
            $daySlotModel = new DaySlotModel();

            $result = $daySlotModel->createDaySlotTable();
            $result = $result && $daySlotModel->insertDay();
            echo 'Day Slot Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupHolidayTable() {
        $result = FALSE;

        try {
            $holidayModel = new HolidayModel();

            $result = $holidayModel->createHolidayTable();
            echo 'Holiday Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupParticipantTable() {
        $result = FALSE;

        try {
            $participantModel = new ParticipantModel();

            $result = $participantModel->createParticipantTable();
            echo 'Participant Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupReservationTable() {
        $result = FALSE;

        try {
            $reservationModel = new ReservationModel();

            $result = $reservationModel->createReservationTable();
            echo 'Reservation Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupRoomTable() {
        $result = FALSE;

        try {
            $roomModel = new RoomModel();
            $result = $roomModel->createRoomTable();
            
            // Insert initial room data
            $result = $result && $roomModel->insertRoom('Dugong', 4, 1, 1);
            $result = $result && $roomModel->insertRoom('Kowari', 4, 1, 1);
            $result = $result && $roomModel->insertRoom('Kancil', 4, 0, 0);
            $result = $result && $roomModel->insertRoom('Emu', 6, 1, 1);
            $result = $result && $roomModel->insertRoom('Koala', 6, 1, 1);
            $result = $result && $roomModel->insertRoom('Wombat', 10, 1, 1);
            $result = $result && $roomModel->insertRoom('Kangaroo', 10, 1, 1);
            $result = $result && $roomModel->insertRoom('Orangutan', 10, 1, 1);
            $result = $result && $roomModel->insertRoom('Tapir', 10, 1, 1);
            $result = $result && $roomModel->insertRoom('Arowana', 10, 1, 1);
            $result = $result && $roomModel->insertRoom('Hornbill', 10, 1, 1);
            $result = $result && $roomModel->insertRoom('Dingo', 6, 1, 1);
            $result = $result && $roomModel->insertRoom('Proboscis', 6, 1, 1);
            $result = $result && $roomModel->insertRoom('Wallaby', 6, 1, 1);
            $result = $result && $roomModel->insertRoom('Porcupine', 6, 1, 1);
            $result = $result && $roomModel->insertRoom('Glider', 10, 1, 1);
            
            echo 'Room Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupTimeSlotTable() {
        $result = FALSE;

        try {
            $timeSlotModel = new TimeSlotModel();

            $result = $timeSlotModel->createTimeSlotTable();
            $result = $timeSlotModel->insertTime('083000', '173000');
            echo 'Time Slot Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupTimeTableSlotTable() {
        $result = FALSE;

        try {
            $timeTableSlotTable = new TimeTableSlotModel();

            $result = $timeTableSlotTable->createTimeTableSlotTable();
            
            // Insert initial data
            // Arowana
            $timeTableSlotTable->insertTimeTableSlot(1, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(1, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(1, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(1, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(1, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(1, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(1, 7, 1);
            
            // Dingo
            $timeTableSlotTable->insertTimeTableSlot(2, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(2, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(2, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(2, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(2, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(2, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(2, 7, 1);
            
            // Dugong
            $timeTableSlotTable->insertTimeTableSlot(3, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(3, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(3, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(3, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(3, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(3, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(3, 7, 1);
            
            // Emu
            $timeTableSlotTable->insertTimeTableSlot(4, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(4, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(4, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(4, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(4, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(4, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(4, 7, 1);
            
            // Hornbill
            $timeTableSlotTable->insertTimeTableSlot(5, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(5, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(5, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(5, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(5, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(5, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(5, 7, 1);
            
            // Kancil
            $timeTableSlotTable->insertTimeTableSlot(6, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(6, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(6, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(6, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(6, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(6, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(6, 7, 1);
            
            // Kangaroo
            $timeTableSlotTable->insertTimeTableSlot(7, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(7, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(7, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(7, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(7, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(7, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(7, 7, 1);
            
            // Koala
            $timeTableSlotTable->insertTimeTableSlot(8, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(8, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(8, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(8, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(8, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(8, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(8, 7, 1);
            
            // Kowari
            $timeTableSlotTable->insertTimeTableSlot(9, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(9, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(9, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(9, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(9, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(9, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(9, 7, 1);
            
            // Orangutan
            $timeTableSlotTable->insertTimeTableSlot(10, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(10, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(10, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(10, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(10, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(10, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(10, 7, 1);
            
            // Porcupine
            $timeTableSlotTable->insertTimeTableSlot(11, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(11, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(11, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(11, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(11, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(11, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(11, 7, 1);
            
            // Proboscis
            $timeTableSlotTable->insertTimeTableSlot(12, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(12, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(12, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(12, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(12, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(12, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(12, 7, 1);
            
            // Wallaby
            $timeTableSlotTable->insertTimeTableSlot(13, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(13, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(13, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(13, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(13, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(13, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(13, 7, 1);
            
            // Wombat
            $timeTableSlotTable->insertTimeTableSlot(14, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(14, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(14, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(14, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(14, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(14, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(14, 7, 1);
            
            // Tapir
            $timeTableSlotTable->insertTimeTableSlot(15, 1, 1);
            $timeTableSlotTable->insertTimeTableSlot(15, 2, 1);
            $timeTableSlotTable->insertTimeTableSlot(15, 3, 1);
            $timeTableSlotTable->insertTimeTableSlot(15, 4, 1);
            $timeTableSlotTable->insertTimeTableSlot(15, 5, 1);
            $timeTableSlotTable->insertTimeTableSlot(15, 6, 1);
            $timeTableSlotTable->insertTimeTableSlot(15, 7, 1);
            
            echo 'Time Table Slot Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupUserTable() {
        $result = FALSE;

        try {
            $userModel = new UserModel();

            $result = $userModel->createUserTable();
            echo "User Table: " . (($result) ? 'Successful' : 'Unsuccessful') . '</p>';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    public function setupDB() {
        $numOfTable = 0;

        try {
            $config = new DBConfiguration();

            $db = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword());

            if ($db->connect_error) {
                throw new Exception('Creating DB:\NConnection to MySQL Server failed!');
            }

            if (!$db->select_db($config->getDbName())) {
                $queryStr = "CREATE DATABASE " . $config->getDbName();
                $db->query($queryStr);
            } else {
                $db->query("DROP TABLE Admin IF EXISTS");
                $db->query("DROP TABLE Blacklist IF EXISTS");
                $db->query("DROP TABLE DaySlot IF EXISTS");
                $db->query("DROP TABLE Holiday IF EXISTS");
                $db->query("DROP TABLE Participant IF EXISTS");
                $db->query("DROP TABLE Reservation IF EXISTS");
                $db->query("DROP TABLE Room IF EXISTS");
                $db->query("DROP TABLE TimeSlot IF EXISTS");
                $db->query("DROP TABLE TimeTableSlot IF EXISTS");
                $db->query("DROP TABLE User IF EXISTS");
            }

            $db->close();

            ($this->setupAdminTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupBlacklistTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupDaySlotTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupHolidayTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupParticipantTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupReservationTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupRoomTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupTimeSlotTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupTimeTableSlotTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupUserTable()) ? $numOfTable++ : $numOfTable+=0;

            if ($numOfTable != 10) {
                $db = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword());

                if ($db->connect_error) {
                    throw new Exception('Creating DB:\NConnection to MySQL Server failed!');
                }

                if ($db->select_db($config->getDbName())) {
                    echo '<p>Previous modification to the MySQL Server will be reverted.<br>No changes will be made to the MySQL Server.</p>';
                    $queryStr = "DROP DATABASE " . $config->getDbName();
                    $db->query($queryStr);
                }

                $db->close();
            }
        } catch (Exception $e) {
            throw $e;
        }

        return $numOfTable;
    }

}

try {
    $dbInstaller = new DBInstaller();
    $numOfSuccessfulTableCreated = $dbInstaller->setupDB();
//    echo '<p>System Setup: ' . (($numOfSuccessfulTableCreated == 10) ? 'Successful' : 'Unsuccessful') . '<br />';
//    echo 'Table created: ' . $numOfSuccessfulTableCreated . '/10</p>';
    if ($numOfSuccessfulTableCreated == 10 && !is_null($numOfSuccessfulTableCreated)) {
        header('Location: registration.php');
    } else {
        echo '<p>System Setup: Not successful.<br />';
        echo ((is_numeric($numOfSuccessfulTableCreated)) ? 'Table(s) created: ' . $numOfSuccessfulTableCreated . '/10' : 'An error has occured.') . '</p>';
    }
} catch (Exception $e) {
    echo '<p class="error_message">' . $e->getMessage() . "</p>";
}
?>