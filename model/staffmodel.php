<?php

//require_once('../inc/config.php');
/**
 * StaffModel Model class for Staff table
 * 
 * @author Liew Kit Loong
 * @version 2012-11-07
 * @package model
 */
class StaffModel {

    private $TABLE_STAFF = "Staff";
    private $COLUMN_STAFFID = "StaffID"; // VARCHAR
    private $COLUMN_STAFF_FIRST_NAME = "StaffFirstName"; // VARCHAR
    private $COLUMN_STAFF_LAST_NAME = "StaffLastName"; // VARCHAR
    private $COLUMN_PASSWORD = "Password"; // VARCHAR
    private $COLUMN_ACTIVATION_CODE = 'ActivationCode'; //VARCHAR
    private $COLUMN_ACTIVATION_STATUS = 'ActivationStatus'; //TINYINT
    private $COLUMN_SUPER_ADMIN = "SuperAdmin"; // BOOLEAN

    /**
     * Create the Staff Table in the database
     * 
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */

    public function createStaffTable() {
        $config = new DBConfiguration();

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "CREATE TABLE $this->TABLE_STAFF (
                $this->COLUMN_STAFFID VARCHAR(15) PRIMARY KEY,
                $this->COLUMN_STAFF_FIRST_NAME VARCHAR(255) NOT NULL,
                $this->COLUMN_STAFF_LAST_NAME VARCHAR(255) NOT NULL,
                $this->COLUMN_PASSWORD VARCHAR(255) NOT NULL,
                $this->COLUMN_ACTIVATION_CODE VARCHAR(4) NOT NULL,
                $this->COLUMN_ACTIVATION_STATUS TINYINT(1) NOT NULL,
                $this->COLUMN_SUPER_ADMIN BOOLEAN NOT NULL)";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        return $result;
    }
    
    public function selectAStaff($staffID) {
        $staffList = array();
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STAFF WHERE $this->COLUMN_STAFFID = '$staffID'";
        $result = $staffTable->query($queryStr);

        if ($staffTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                $staffList[$i][$this->COLUMN_STAFFID] = $row[$this->COLUMN_STAFFID];
                $staffList[$i][$this->COLUMN_STAFF_FIRST_NAME] = $row[$this->COLUMN_STAFF_FIRST_NAME];
                $staffList[$i][$this->COLUMN_STAFF_LAST_NAME] = $row[$this->COLUMN_STAFF_LAST_NAME];
                $staffList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
                $staffList[$i][$this->COLUMN_SUPER_ADMIN] = $row[$this->COLUMN_SUPER_ADMIN];
            }
        }

        $staffTable->close();

        return $staffList;
    }

  
    public function selectStaff($staffID, $password) {
        $staffList = null;
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT $this->COLUMN_SUPER_ADMIN FROM $this->TABLE_STAFF WHERE $this->COLUMN_STAFFID LIKE '$staffID' AND $this->COLUMN_PASSWORD = '" . crypt($password, CRYPT_BLOWFISH) . "'";
        $result = $staffTable->query($queryStr);

        if ($staffTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                $staffList[$i] = $row[$this->COLUMN_SUPER_ADMIN];
            }
        }

        $staffTable->close();

        return $staffList;
    }

    public function selectAllStaff() {
        $staffList = null;
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STAFF WHERE $this->COLUMN_STAFFID NOT LIKE '" . $_SESSION['ID'] . "'";
        $result = $staffTable->query($queryStr);

        if ($staffTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) 
            {
                $row = $result->fetch_assoc();
                 $staffList[$i][$this->COLUMN_STAFFID] = $row[$this->COLUMN_STAFFID];
                $staffList[$i][$this->COLUMN_STAFF_FIRST_NAME] = $row[$this->COLUMN_STAFF_FIRST_NAME];
                $staffList[$i][$this->COLUMN_STAFF_LAST_NAME] = $row[$this->COLUMN_STAFF_LAST_NAME];
                $staffList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
                $staffList[$i][$this->COLUMN_SUPER_ADMIN] = $row[$this->COLUMN_SUPER_ADMIN];
            }
        }

        $staffTable->close();

        return $staffList;
    }

    public function selectStaffActivationStatus($staffID) 
    {
        $activationStatus = -1;
        $config = new DBConfiguration();

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) 
        {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT $this->COLUMN_ACTIVATION_STATUS FROM $this->TABLE_STAFF WHERE $this->COLUMN_STAFFID = '$staffID'";
        $result = $staffTable->query($queryStr);

        if ($result->num_rows == 1) 
        {
            $row = $result->fetch_assoc();
            ($row[$this->COLUMN_ACTIVATION_STATUS] == 1) ? $activationStatus = 1 : $activationStatus = 0;
        }

        $staffTable->close();

        return $activationStatus;
    }

    public function selectStaffActivationCode($staffID) 
    {
        $activationCode = 0;
        $config = new DBConfiguration();

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) 
        {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT $this->COLUMN_ACTIVATION_CODE FROM $this->TABLE_STAFF WHERE $this->COLUMN_STAFFID = '$staffID'";
        $result = $staffTable->query($queryStr);

        if ($result->num_rows == 1) 
        {
            $row = $result->fetch_assoc();
            $activationCode = $row[$this->COLUMN_ACTIVATION_CODE];
        }

        $staffTable->close();

        return $activationCode;
    }

    /**
     * Insert a new record into the Admin table
     * 
     * @param String $staffID Staff ID of the new staff
     * @param String $password password for the new staff
     * @param String $firstname first name of the new staff
     * @param String $lastname last name of the new staff
     * @param String $superAdmin super admin status of the new staff
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function insertStaff($staffID,  $firstname,$lastname,$password, $activationNumber) {
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "INSERT INTO $this->TABLE_STAFF VALUES('$staffID', '$firstname','$lastname', '" . crypt($password, CRYPT_BLOWFISH) . "','$activationNumber', 0, 0)";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        return $result;
    }

    /**
     * Upgrade the status of an staff to Super Admin
     * 
     * @param string $staffID Staff ID of the staff whose status is to be upgraded
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function updateStaffToSA($staffID) {
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "UPDATE $this->TABLE_STAFF SET $this->COLUMN_SUPER_ADMIN = 1 WHERE $this->COLUMN_STAFFID LIKE '$staffID'";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        if (!$result) {
            throw new Exception('Staff ID does not exist.');
        }
    }

    /**
     * Downgrade the status of an staff to Normal Staff
     * 
     * @param string $staffID Staff ID of the staff whose status is to be downgraded
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function updateStaffToNA($staffID) {
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "UPDATE $this->TABLE_STAFF SET $this->COLUMN_SUPER_ADMIN = 0 WHERE $this->COLUMN_STAFFID LIKE '$staffID'";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        if (!$result) {
            throw new Exception('Staff ID does not exist.');
        }
    }

    /**
     * Update the password of an staff
     * 
     * @param string $staffID Staff ID of the staff whose password if to be updated
     * @param string $password new password to replace the old password
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function updateStaffPassword($staffID, $password) {
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "UPDATE $this->TABLE_STAFF SET $this->COLUMN_PASSWORD = '" . crypt($password, CRYPT_BLOWFISH) . "' WHERE $this->COLUMN_STAFFID LIKE '$staffID'";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        return $result;
    }

    public function updateActivationCode($staffID, $activationCode) {
        $result = FALSE;
        $config = new DBConfiguration();

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        $queryStr = "UPDATE $this->TABLE_STAFF SET $this->COLUMN_ACTIVATION_CODE = '$activationCode' WHERE $this->COLUMN_STAFFID = '$staffID'";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        return $result;
    }

    public function updateActivationStatus($staffID, $activationCode) {
        $result = FALSE;
        $config = new DBConfiguration();

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        $queryStr = "UPDATE $this->TABLE_STAFF SET $this->COLUMN_ACTIVATION_STATUS = 1 WHERE $this->COLUMN_STAFFID = '$staffID' AND $this->COLUMN_ACTIVATION_CODE = '$activationCode' AND $this->COLUMN_ACTIVATION_STATUS = 0";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        return $result;
    }

    public function updateAccountStatus($staffID, $accountStatus) {
        $result = FALSE;
        $config = new DBConfiguration();

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        $queryStr = "UPDATE $this->TABLE_STAFF SET $this->COLUMN_ACTIVATION_STATUS = $accountStatus WHERE $this->COLUMN_STAFFID = '$staffID' AND $this->COLUMN_ACTIVATION_STATUS != $accountStatus";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        return $result;
    }

    /**
     * Delete a record from the Staff table
     * 
     * @param string $staffID Staff ID of the staff to be removed
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function deleteStaff($staffID) {
        $config = new DBConfiguration;

        $staffTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($staffTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "DELETE FROM $this->TABLE_STAFF WHERE $this->COLUMN_STAFFID LIKE '$staffID'";
        $result = $staffTable->query($queryStr);

        $staffTable->close();

        if (!$result) {
            throw new Exception('Staff ID does not exist.');
        }
    }

}

?>