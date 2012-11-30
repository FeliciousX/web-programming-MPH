<?php

//require_once('../model/StaffModel.php');
/**
 * StaffController
 * 
 * @author Liew Kit Loong
 * @version 2012-11-07
 * @package controller
 */
class StaffController {

    public function getAllStaff() {
        $result = FALSE;

        try {
            $staffModel = new StaffModel();
            $result = $staffModel->selectAllStaff();
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    public function getStaff($staffID) {
        $result = FALSE;

        $staffID = stripslashes($staffID);

        if (empty($staffID)) {
            throw new Exception('Staff ID cannot be empty.');
        }

        try {
            $staffModel = new StaffModel();
            $result = $staffModel->selectAStaff($staffID);
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    /**
     * Authenticate the identity of an administrator
     * @param string $userName username of the administrator to be authenticated
     * @param string $password password of the administrator to be authenticated
     * @return boolean TRUE if valid, FALSE if otherwise
     * @throws Exception exception thrown by model class
     */
    public function authenticateStaff($userName, $password) {
        $result = FALSE;

        try {
            $userName = stripslashes($userName);
            $password = stripslashes($password);

            if (empty($userName) && empty($password)) {
                throw new Exception('Username and password must not be empty.');
            } elseif (empty($userName) && !empty($password)) {
                throw new Exception('Username must not be empty.');
            } elseif (!empty($userName) && empty($password)) {
                throw new Exception('Password must not be empty.');
            }

            if (empty($userName) || empty($password)) {
                throw new Exception('All fields are required.');
            }

            $staffModel = new StaffModel();
            $result = $staffModel->selectStaff($userName, $password);
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    

    function removeStaff($staffID) {
        try {
            $staffID = stripslashes($staffID);

            if (empty($staffID)) {
                throw new Exception('Empty Staff ID field.');
            }

            $staffModel = new StaffModel();
            $staffModel->deleteStaff($staffID);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function promoteToSuperAdmin($staffID) {
        try {
            $staffID = stripslashes($staffID);

            if (empty($staffID)) {
                throw new Exception('Empty Staff ID field.');
            }

            $staffModel = new StaffModel();
            $staffModel->updateStaffToSA($staffID);
        } catch (Exception $e) {
            throw $e;
        }
    }

    function demoteToNormalAdmin($staffID) {
        try {
            $staffID = stripslashes($staffID);

            if (empty($staffID)) {
                throw new Exception('Empty Staff ID field.');
            }

            $staffModel = new StaffModel();
            $staffModel->updateStaffToNA($staffID);
        } catch (Exception $e) {
            throw $e;
        }
    }

   /** public function changePassword($staffID, $password) 
    {
        $result = FALSE;

        try {
            if (empty($staffID) || empty($password)) {
                throw new Exception('All fields are required.');
            }

            $staffModel = new StaffModel();
            $result = $staffModel->updateStaffPassword($staffID, $password);
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }**/

    
 public function changePassword($currentPassword, $newPassword, $repeatNewPassword, $staffID) {
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

       

            $staffModel = new StaffModel();
            $result = $staffModel->updateStaffPassword($staffID, $newPassword);

            if ($result) {
                mail($staffID . '@swinburne.edu.my', 'Password Change', 'Your new password: ' . $newPassword . "\nIf you do not change your password, please contact the administrator immediately.");
            }
        } catch (Exception $e) {
            throw $e;
        }

        return $result;
    }

    public function resetPassword($staffID) {
        try {
            $staffID = stripslashes($staffID);

            if (empty($staffID)) {
                throw new Exception('Staff ID is required.');
            }

            mt_srand(time());
            $password = substr(md5(mt_rand(0, mt_getrandmax())), 0, 4);

            $staffModel = new StaffModel();
            $result = $staffModel->updateStudentPassword($staffID, $password);

            if ($result) {
                $header = 'From: noreply@mph.swinburne.edu.my';
                mail($staffID . '@swinburne.edu.my', 'Password Reset', 'Your new password: ' . $password . "\nIf you do not reset your password, please contact the administrator immediately.", $header);
            } else {
                throw new Exception('Invalid Staff ID.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

public function register($staffID, $firstName, $lastName, $password, $repeatPassword, $captcha) {
        try {
            $staffID = stripslashes($staffID);
            $firstName = stripslashes($firstName);
            $lastName = stripslashes($lastName);
            $password = stripslashes($password);
            $repeatPassword = stripslashes($repeatPassword);
            $captcha = stripslashes($captcha);

            if (empty($staffID) || empty($firstName) || empty($lastName) || empty($password) || empty($repeatPassword) || empty($captcha)) {
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

            $studentController = new StudentController();
            $student = $studentController->getStudent($staffID);

            if (sizeof($student) != 0) {
                throw new Exception('Invalid Staff ID.');
            }

            $staffModel = new StaffModel();
            
            $result = $staffModel->insertStaff($staffID, $firstName,$lastName, $password, $activationCode);

            if ($result) {
                $header = 'From: noreply@mph.swinburne.edu.my';
                mail($staffID . '@swinburne.edu.my', 'Account Activation', 'Thank you for registering with the Swinburne Library Discussion Room Booking System. Your activation code: ' . $activationCode
                     . ' . Click this link to automatically activate your account. http://polytestsite.site90.com/WebProgramming/activate.php?userID=' . $staffID . '&code=' . $activationCode
                     . ' or click this link to enter your code manually http://polytestsite.site90.com/WebProgramming/activate.php', $header);
            } else {
                throw new Exception('Staff ID already exist.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

     public function addAdmin($staffID, $password, $repeatPassword, $firstname,$lastname) {
        try {
            $staffID = stripslashes($staffID);
            $password = stripslashes($password);
            $repeatPassword = stripslashes($repeatPassword);
            $firstname = stripslashes($firstname);
            $lastname = stripslashes($lastname);

            if (empty($staffID) || empty($password) || empty($repeatPassword) || empty($firstname) || empty($lastname)) {
                throw new Exception('All fields are required.');
            }

            if (is_numeric($firstname)) {
                throw new Exception('First Name must not be numeric.');
            }

             if (is_numeric($lastname)) {
                throw new Exception('Last Name must not be numeric.');
            }

            if (strcmp($password, $repeatPassword) != 0) {
                throw new Exception('Both password fileds must be the same.');
            }

             mt_srand(time());
            $activationCode = substr(md5(mt_rand(0, mt_getrandmax())), 0, 4);

            $studentController = new StudentController();
            $student = $studentController->getStudent($staffID);

              if (sizeof($student) != 0) {
                throw new Exception('Invalid Staff ID.');
            }

            $staffModel = new StaffModel();
            $result = $staffModel->insertStaff($staffID, $firstname,$lastname,$password,$activationCode,1,1);

            if (!$result) {
                throw new Exception('Staff ID already exist.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function activate($staffID, $activationCode) {
        try {
            $staffID = stripslashes($staffID);
            $activationCode = stripslashes($activationCode);

            if (empty($staffID) || empty($activationCode)) {
                throw new Exception('All fields are required.');
            }

            $staffModel = new StaffModel();
            $activationStatus = $staffModel->selectStaffActivationStatus($staffID);

            if ($activationStatus == -1) {
                throw new Exception('Invalid Staff ID.');
            } elseif ($activationStatus == 1) {
                throw new Exception('Account is already activated.');
            }

            if (strcmp($staffModel->selectStaffActivationCode($staffID), $activationCode) != 0) {
                throw new Exception('Invalid activation code. Please refer to your email.');
            }

            if (!$staffModel->updateActivationStatus($staffID, $activationCode)) {
                throw new Exception('Invalid activation code.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function activateUser($staffID) {
        try {
            $staffID = stripslashes($staffID);

            if (empty($staffID)) {
                throw new Exception('Staff ID is required.');
            }

            $staffModel = new StaffModel();
            $accountStatus = $staffModel->updateAccountStatus($staffID, 1);

            if (!$accountStatus) {
                throw new Exception('Account is already activated.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deactivateUser($staffID) 
    {
        try 
        {
            $staffID = stripslashes($staffID);

            if (empty($staffID)) 
            {
                throw new Exception('Staff ID is required.');
            }

            $staffModel = new StaffModel();
            $accountStatus = $staffModel->updateAccountStatus($staffID, 0);

            mt_srand(time());
            $activationCode = substr(md5(mt_rand(0, mt_getrandmax())), 0, 4);

            $staffModel->updateActivationCode($staffID, $activationCode);

            if (!$accountStatus) 
            {
                throw new Exception('Account is already deactivated.');
            }
        } catch (Exception $e) 
        {
            throw $e;
        }
    }

}



?>