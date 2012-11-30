<?php

//require_once('../model/StudentModel.php');
/**
 * StudentController
 *
 * @author Liew Kit Loong
 * @version 2012-11-07
 * @package controller
 */
class StudentController {

    public function getAllStudent() {
        $studentModel = new StudentModel();
        return $studentModel->selectAllStudent();
    }

      public function getStudent($studentID) {
        $result = FALSE;

        $studentID = stripslashes($studentID);

        if (empty($studentID)) {
            throw new Exception('Student ID cannot be empty.');
        }

        try {
            $studentModel = new StudentModel();
            $result = $studentModel->selectAStudent($studentID);
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    public function getAllStudentByID($studentID) {
        $studentID = stripslashes($studentID);

        if (empty($studentID)) {
            throw new Exception('Student ID is required.');
        }

        $studentModel = new StudentModel();
        return $studentModel->selectAllStudentByID($studentID);
    }

    public function getAllStudentByFirstName($studentFirstName) {
        $studentName = stripslashes($studentFirstName);

        if (empty($studentFirstName)) {
            throw new Exception('Student Name is required.');
        }

        $studentModel = new StudentModel();
        return $studentModel->selectAllStudentByFirstName($studentFirstName);
    }

    public function getAllStudentByLastName($studentLastName) {
        $studentLastName = stripslashes($studentLastName);

        if (empty($studentLastName)) {
            throw new Exception('Student Last Name is required.');
        }

        $studentModel = new StudentModel();
        return $studentModel->selectAllStudentByLastName($studentLastName);
    }


    /**
     * Authenticate the identity of a user 
     * @param string $username username of the student to be authenticated
     * @param string $password password of the student to be authenticated
     * @return boolean TRUE if valid, FALSE if otherwise
     * @throws Exception
     */
    public function authenticateUser($username, $password) {
        $result = FALSE;

        try {
            $username = stripslashes($username);
            $password = stripslashes($password);

            if (empty($username) && empty($password)) {
                throw new Exception('Username and password must not be empty.');
            } elseif (empty($username) && !empty($password)) {
                throw new Exception('Username must not be empty.');
            } elseif (!empty($username) && empty($password)) {
                throw new Exception('Password must not be empty.');
            }

            $studentModel = new StudentModel();
            $result = $studentModel->selectStudent($username, $password);
        } catch (ErrorException $e) {
            throw $e;
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    public function changePassword($currentPassword, $newPassword, $repeatNewPassword, $studentID) {
        $result = FALSE;

        try {
            $currentPassword = stripslashes($currentPassword);
            $newPassword = stripcslashes($newPassword);
            $repeatNewPassword = stripslashes($repeatNewPassword);

            if (empty($currentPassword) || empty($newPassword) || empty($repeatNewPassword)) {
                throw new Exception('All fields are required.');
            }

            if (strcmp($newPassword, $repeatNewPassword) != 0) {
                throw new Exception('Both the new password fields must have the same value.');
            }

         

            $studentModel = new StudentModel();
            $result = $studentModel->updateStudentPassword($studentID, $newPassword);

            if ($result) {
                mail($studentID . '@students.swinburne.edu.my', 'Password Change', 'Your new password: ' . $newPassword . "\nIf you do not change your password, please contact the administrator immediately.");
            }
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    public function resetPassword($studentID) {
        try {
            $studentID = stripslashes($studentID);

            if (empty($studentID)) {
                throw new Exception('Student ID is required.');
            }

            mt_srand(time());
            $password = substr(md5(mt_rand(0, mt_getrandmax())), 0, 4);

            $studentModel = new StudentModel();
            $result = $studentModel->updateStudentPassword($studentID, $password);

            if ($result) {
                $header = 'From: noreply@mph.swinburne.edu.my';
                mail($studentID . '@students.swinburne.edu.my', 'Password Reset', 'Your new password: ' . $password . "\nIf you do not reset your password, please contact the administrator immediately.", $header);
            } else {
                throw new Exception('Invalid Student ID.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function removeStudent($studentID) {
        try {
            $studentID = stripslashes($studentID);

            if (empty($studentID)) {
                throw new Exception('Student ID is required.');
            }

            $studentModel = new StudentModel();
            $studentModel->deleteStudent($studentID);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param string $studentID
     * @param string $firstName
     * @param string $lastName
     * @param string $contact
     * @param string $password
     * @param string $repeatPassword
     * @param string $captcha
     * @return boolean TRUE if successful, FALSE if otherwise
     * @throws Exception 
     */
    public function register($studentID, $firstName, $lastName, $password, $repeatPassword, $captcha) {
        try {
            $studentID = stripslashes($studentID);
            $firstName = stripslashes($firstName);
            $lastName = stripslashes($lastName);
            $password = stripslashes($password);
            $repeatPassword = stripslashes($repeatPassword);
            $captcha = stripslashes($captcha);

            if (empty($studentID) || empty($firstName) || empty($lastName) || empty($password) || empty($repeatPassword) || empty($captcha)) {
                throw new Exception('All fields are required.');
            }

            if (is_numeric($firstName)) {
                throw new Exception('First name must not be numeric.');
            }

            if (is_numeric($lastName)) {
                throw new Exception('Last name must not be numeric.');
            }

            if (strcmp($password, $repeatPassword) != 0) {
                throw new Exception('Password does not match.');
            }

            if (strlen($password) < 6) {
                throw new Exception('Password must be 6 characters or more.');
            }

            $securimage = new Securimage();

            if ($securimage->check($captcha) == FALSE) {
                throw new Exception('Wrong captcha.');
            }

            
            mt_srand(time());
            $activationCode = substr(md5(mt_rand(0, mt_getrandmax())), 0, 4);

            $staffController = new StaffController();
            $staff = $staffController->getStaff($studentID);

            if (sizeof($staff) != 0) {
                throw new Exception('Invalid Student ID.');
            }

            $studentModel = new StudentModel();
            $result = $studentModel->insertStudent($studentID, $firstName,$lastName, $password, $activationCode);

            if ($result) {
                $header = 'From: noreply@mph.swinburne.edu.my';
                mail($studentID . '@students.swinburne.edu.my', 'Account Activation', 'Thank you for registering with the Swinburne Library Discussion Room Booking System. Your activation code: ' . $activationCode
                     . ' . Click this link to automatically activate your account. http://polytestsite.site90.com/WebProgramming/activate.php?userID=' . $staffID . '&code=' . $activationCode
                     . ' or click this link to enter your code manually http://polytestsite.site90.com/WebProgramming/activate.php', $header);
            } else {
                throw new Exception('Student ID already exist.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function activate($studentID, $activationCode) {
        try {
            $studentID = stripslashes($studentID);
            $activationCode = stripslashes($activationCode);

            if (empty($studentID) || empty($activationCode)) {
                throw new Exception('All fields are required.');
            }

            $studentModel = new StudentModel();
            $activationStatus = $studentModel->selectStudentActivationStatus($studentID);

            if ($activationStatus == -1) {
                throw new Exception('Invalid Student ID.');
            } elseif ($activationStatus == 1) {
                throw new Exception('Account is already activated.');
            }

            if (strcmp($studentModel->selectStudentActivationCode($studentID), $activationCode) != 0) {
                throw new Exception('Invalid activation code. Please refer to your email.');
            }

            if (!$studentModel->updateActivationStatus($studentID, $activationCode)) {
                throw new Exception('Invalid activation code.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function activateUser($studentID) {
        try {
            $studentID = stripslashes($studentID);

            if (empty($studentID)) {
                throw new Exception('Student ID is required.');
            }

            $studentModel = new StudentModel();
            $accountStatus = $studentModel->updateAccountStatus($studentID, 1);

            if (!$accountStatus) {
                throw new Exception('Account is already activated.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deactivateUser($studentID) {
        try {
            $studentID = stripslashes($studentID);

            if (empty($studentID)) {
                throw new Exception('Student ID is required.');
            }

            $studentModel = new StudentModel();
            $accountStatus = $studentModel->updateAccountStatus($studentID, 0);

            mt_srand(time());
            $activationCode = substr(md5(mt_rand(0, mt_getrandmax())), 0, 4);

            $studentModel->updateActivationCode($studentID, $activationCode);

            if (!$accountStatus) {
                throw new Exception('Account is already deactivated.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>