<?php

//require_once('../inc/config.php');
/**
 * Description of StudentModel
 *
 * @author Liew Kit Loong
 * @version 2012-11-07
 * @package model
 */
class StudentModel {

    private $TABLE_STUDENT = "Student";
    private $COLUMN_STUDENTID = "StudentID"; // VARCHAR
    private $COLUMN_STUDENT_FIRST_NAME = "StudentFirstName"; // VARCHAR
    private $COLUMN_STUDENT_LAST_NAME = "StudentLastName"; // VARCHAR
    private $COLUMN_PASSWORD = "Password"; // VARCHAR
    private $COLUMN_ACTIVATION_CODE = 'ActivationCode'; //VARCHAR
    private $COLUMN_ACTIVATION_STATUS = 'ActivationStatus'; //TINYINT

    /**
     * Create the Student table in the database
     * 
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */

    public function createStudentTable() {
        $config = new DBConfiguration();

        $studentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($studentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "CREATE TABLE $this->TABLE_STUDENT(
                $this->COLUMN_STUDENTID VARCHAR(15) PRIMARY KEY,
                $this->COLUMN_STUDENT_FIRST_NAME VARCHAR(255) NOT NULL,
                $this->COLUMN_STUDENT_LAST_NAME VARCHAR(255) NOT NULL,
                $this->COLUMN_PASSWORD VARCHAR(255) NOT NULL,
                $this->COLUMN_ACTIVATION_CODE VARCHAR(4) NOT NULL,
                $this->COLUMN_ACTIVATION_STATUS TINYINT(1) NOT NULL)";
        $result = $studentTable->query($queryStr);

        $studentTable->close();

        return $result;
    }

       public function selectAStudent($studentID) {
        $studentList = array();
        $config = new DBConfiguration;

        $studentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($studentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID = '$studentID'";
        $result = $studentTable->query($queryStr);

        if ($studentTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                $studentList[$i][$this->COLUMN_STUDENTID] = $row[$this->COLUMN_STUDENTID];
                $studentList[$i][$this->COLUMN_STUDENT_FIRST_NAME] = $row[$this->COLUMN_STUDENT_FIRST_NAME];
                $studentList[$i][$this->COLUMN_STUDENT_LAST_NAME] = $row[$this->COLUMN_STUDENT_LAST_NAME];
                $studentList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
                
            }
        }

        $studentTable->close();

        return $studentList;
    }

  


    public function selectAllStudent() {
        $studentList = array();
        $config = new DBConfiguration();

        $studentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($studentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STUDENT";
        $result = $studentTable->query($queryStr);

        if ($studentTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                $studentList[$i][$this->COLUMN_STUDENTID] = $row[$this->COLUMN_STUDENTID];
                $studentList[$i][$this->COLUMN_STUDENT_FIRST_NAME] = $row[$this->COLUMN_STUDENT_FIRST_NAME];
                $studentList[$i][$this->COLUMN_STUDENT_LAST_NAME] = $row[$this->COLUMN_STUDENT_LAST_NAME];
                $studentList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
            }
        }

        $studentTable->close();

        return $studentList;
    }

    public function selectAllStudentByID($studentID) {
        $studentList = array();
        $config = new DBConfiguration();

        $studentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($studentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID = '$studentID'";
        $result = $studentTable->query($queryStr);

        if ($studentTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                 $row = $result->fetch_assoc();
               $studentList[$i][$this->COLUMN_STUDENTID] = $row[$this->COLUMN_STUDENTID];
                $studentList[$i][$this->COLUMN_STUDENT_FIRST_NAME] = $row[$this->COLUMN_STUDENT_FIRST_NAME];
                $studentList[$i][$this->COLUMN_STUDENT_LAST_NAME] = $row[$this->COLUMN_STUDENT_LAST_NAME];
                $studentList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
            }
        }

        $studentTable->close();

        return $studentList;
    }

    public function selectAllStudentByFirstName($studentFirstName) {
        $studentList = array();
        $config = new DBConfiguration();

        $studentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($studentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENT_FIRST_NAME LIKE '%$studentFirstName%'";
        $result = $studentTable->query($queryStr);

        if ($StudentTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                 $row = $result->fetch_assoc();
               $studentList[$i][$this->COLUMN_STUDENTID] = $row[$this->COLUMN_STUDENTID];
                $studentList[$i][$this->COLUMN_STUDENT_FIRST_NAME] = $row[$this->COLUMN_STUDENT_FIRST_NAME];
                $studentList[$i][$this->COLUMN_STUDENT_LAST_NAME] = $row[$this->COLUMN_STUDENT_LAST_NAME];
                $studentList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
            }
        }

        $studentTable->close();

        return $studentList;
    }

    public function selectAllStudentByLastName($studentLastName) {
        $studentList = array();
        $config = new DBConfiguration();

        $studentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($studentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT * FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENT_LAST_NAME LIKE '%$studentLastName%'";
        $result = $studentTable->query($queryStr);

        if ($studentTable->affected_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
               $studentList[$i][$this->COLUMN_STUDENTID] = $row[$this->COLUMN_STUDENTID];
                $studentList[$i][$this->COLUMN_STUDENT_FIRST_NAME] = $row[$this->COLUMN_STUDENT_FIRST_NAME];
                $studentList[$i][$this->COLUMN_STUDENT_LAST_NAME] = $row[$this->COLUMN_STUDENT_LAST_NAME];
                $studentList[$i][$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
            }
        }

        $studentTable->close();

        return $studentList;
    }

    public function selectStudentID($studentID) {
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($StudentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT $this->COLUMN_STUDENTID FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID LIKE '$studentID'";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        return (!$result) ? TRUE : FALSE;
    }



 

    public function selectStudentActivationStatus($studentID) {
        $activationStatus = -1;
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($StudentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT $this->COLUMN_ACTIVATION_STATUS FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID = '$studentID'";
        $result = $StudentTable->query($queryStr);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            ($row[$this->COLUMN_ACTIVATION_STATUS] == 1) ? $activationStatus = 1 : $activationStatus = 0;
        }

        $StudentTable->close();

        return $activationStatus;
    }

    public function selectStudentActivationCode($studentID) {
        $activationCode = 0;
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($StudentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "SELECT $this->COLUMN_ACTIVATION_CODE FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID = '$studentID'";
        $result = $StudentTable->query($queryStr);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $activationCode = $row[$this->COLUMN_ACTIVATION_CODE];
        }

        $StudentTable->close();

        return $activationCode;
    }

    /**
     * Select a student from the Student table based on StudentID and Password
     * 
     * @param string $studentID Student ID of the student to be retrieved
     * @param string $password password of the student to be retrieved
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connectionn error
     */
    public function selectStudent($studentID, $password) {
        try {
            $student = array();
            $config = new DBConfiguration();

            $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

            if (strcmp($StudentTable->connect_error, "") != 0) {
                throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
            }

            $queryStr = "SELECT $this->COLUMN_ACTIVATION_STATUS FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID LIKE '$studentID' AND $this->COLUMN_PASSWORD LIKE '" . crypt($password, CRYPT_BLOWFISH) . "'";
            $result = $StudentTable->query($queryStr);

            if ($StudentTable->affected_rows == 1) {
                $row = $result->fetch_assoc();
                $student[$this->COLUMN_ACTIVATION_STATUS] = $row[$this->COLUMN_ACTIVATION_STATUS];
            }

            $StudentTable->close();

            return $student;
        } catch (ErrorException $e) {
            throw $e;
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Insert a new student into the Student table
     * 
     * @param string $studentID Student ID of the student to be inserted
     * @param string $studentFirstName student first name of the student to be inserted
     * @param string $studentLastName student last name of the student to be inserted
     * @param string $password password of the student to be inserted
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception conneection error
     */
    public function insertStudent($studentID, $studentFirstName,$studentLastName, $password, $activationNumber) {
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($StudentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "INSERT INTO $this->TABLE_STUDENT VALUES('$studentID', '$studentFirstName', '$studentLastName','" . crypt($password, CRYPT_BLOWFISH) . "', '$activationNumber', 0)";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        return $result;
    }

    /**
     * Update a Student's password
     * 
     * @param string $studentID Student OD of the Student whose password is to be updated
     * @param string $password new password to replace the old password
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function updateStudentPassword($studentID, $password) {
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($StudentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "UPDATE $this->TABLE_STUDENT SET $this->COLUMN_PASSWORD = '" . crypt($password, CRYPT_BLOWFISH) . "' WHERE $this->COLUMN_STUDENTID LIKE '$studentID'";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        return $result;
    }
    
    public function updateActivationCode($studentID, $activationCode) {
        $result = FALSE;
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        $queryStr = "UPDATE $this->TABLE_STUDENT SET $this->COLUMN_ACTIVATION_CODE = '$activationCode' WHERE $this->COLUMN_STUDENTID = '$studentID'";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        return $result;
    }

    public function updateActivationStatus($studentID, $activationCode) {
        $result = FALSE;
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        $queryStr = "UPDATE $this->TABLE_STUDENT SET $this->COLUMN_ACTIVATION_STATUS = 1 WHERE $this->COLUMN_STUDENTID = '$studentID' AND $this->COLUMN_ACTIVATION_CODE = '$activationCode' AND $this->COLUMN_ACTIVATION_STATUS = 0";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        return $result;
    }

    public function updateAccountStatus($studentID, $accountStatus) {
        $result = FALSE;
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        $queryStr = "UPDATE $this->TABLE_STUDENT SET $this->COLUMN_ACTIVATION_STATUS = $accountStatus WHERE $this->COLUMN_STUDENTID = '$studentID' AND $this->COLUMN_ACTIVATION_STATUS != $accountStatus";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        return $result;
    }

    /**
     * Delete a student from the Student table
     * 
     * @param string $studentID Student ID of the student to be deleted
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception connection error
     */
    public function deleteStudent($studentID) {
        $config = new DBConfiguration();

        $StudentTable = new mysqli($config->getDbHost(), $config->getDbUserName(), $config->getDbPassword(), $config->getDbName());

        if (strcmp($StudentTable->connect_error, "") != 0) {
            throw new Exception('We are currently experiencing some heavy traffic. Please try again later.');
        }

        $queryStr = "DELETE FROM $this->TABLE_STUDENT WHERE $this->COLUMN_STUDENTID = '$studentID'";
        $result = $StudentTable->query($queryStr);

        $StudentTable->close();

        if (!$result) {
            throw new Exception('Student ID does not exist.');
        }
    }

}

?>