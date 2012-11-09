<?php

require_once('../inc/config.php');
require_once('../model/StaffModel.php');
require_once('../model/StudentModel.php');
require_once('../model/BookingModel.php');

/**
 * Create Database into MySQL Server
 */
class DBInstaller {

    private function setupStaffTable() {
        $result = FALSE;

        try {
            $staffModel = new StaffModel();

            $result = $staffModel->createStaffTable();
            echo '<p>Staff Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupStudentTable() {
        $result = FALSE;

        try {
            $studentModel = new StudentModel();

            $result = $studentModel->createStudentTable();
            echo 'Student Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    private function setupBoookingTable() {
        $result = FALSE;

        try {
            $bookingModel = new BookingModel();

            $result = $bookingModel->createBookingTable();
            echo 'Booking Table: ' . (($result) ? 'Successful' : 'Unsuccessful') . '<br />';
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
                throw new Exception('Creating DB: Connection to MySQL Server failed!');
            }

            if (!$db->select_db($config->getDbName())) {
                $queryStr = "CREATE DATABASE " . $config->getDbName();
                $db->query($queryStr);
            } else {
                $db->query("DROP TABLE Staff IF EXISTS");
                $db->query("DROP TABLE Student IF EXISTS");
                $db->query("DROP TABLE Booking IF EXISTS");
            }

            $db->close();

            ($this->setupStaffTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupStudentTable()) ? $numOfTable++ : $numOfTable+=0;
            ($this->setupBoookingTable()) ? $numOfTable++ : $numOfTable+=0;

            if ($numOfTable != 3) {
                $db = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword());

                if ($db->connect_error) {
                    throw new Exception('Creating DB: Connection to MySQL Server failed!');
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
    if ($numOfSuccessfulTableCreated == 3 && !is_null($numOfSuccessfulTableCreated)) {
        echo 'boobs';
    } else {
        echo '<p>System Setup: Not successful.<br />';
        echo ((is_numeric($numOfSuccessfulTableCreated)) ? 'Table(s) created: ' . $numOfSuccessfulTableCreated . '/3' : 'An error has occured.') . '</p>';
    }
} catch (Exception $e) {
    echo '<p class="error_message">' . $e->getMessage() . "</p>";
}
?>