<?php

require_once('controller/SessionManager.php');
require_once('controller/StudentController.php');
require_once('controller/StaffController.php');
require_once('model/StudentModel.php');
require_once('model/StaffModel.php');

/**
 * Description of ChangePasswordView
 *
 * @author Liew Kit Loong
 * @version 2012-11-18
 * @package view
 */
class ChangePasswordView {
    
    public function validateSession() {
        $sessionManager = new SessionManager();
        
        if ($sessionManager->authenticateReservationSession()) {
            header('Location: ../reservation');
            exit;
        }

        if (!$sessionManager->authenticateSession()) {
            header('Location: ../index.php');
            exit;
        }
    }

    public function changeUserPassword()
    {

         if (isset($_POST['Submit']) && isset($_POST['Password']) && isset($_POST['NewPassword']) && isset($_POST['RepeatNewPassword'])) 
    {
        try
        {
             $currentPassword = $_POST['Password'];
                $newPassword = $_POST['NewPassword'];
                $repeatNewPassword = $_POST['RepeatNewPassword'];
                $ID = $_SESSION['ID'];

            $staffController = new StaffController();
            $studentController = new StudentController();
            $staff = $staffController->getStaff($ID);
            $student = $studentController->getStudent($ID);

            if (sizeof($staff) == 1) {
                $result = $staffController->changePassword($currentPassword, $newPassword, $repeatNewPassword, $ID);
            }
                

            else if(sizeof($student) == 1){

            $result = $studentController->changePassword($currentPassword, $newPassword, $repeatNewPassword, $ID);
                        }

                if ($result) {
                    echo '<p class="success_message">Your password has been successfully changed.</p>';
                } else {
                    throw new Exception('Failed to change your password. Please contact the system administrator.');
                }

        } 
            catch (Exception $e) 
            {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
           

    }

public function changeStudentPassword() {
 
    if (isset($_POST['Submit']) && isset($_POST['Password']) && isset($_POST['NewPassword']) && isset($_POST['RepeatNewPassword'])) 
    {
        try
        {

                $studentController = new StudentController();

                $currentPassword = $_POST['Password'];
                $newPassword = $_POST['NewPassword'];
                $repeatNewPassword = $_POST['RepeatNewPassword'];
                $studentID = $_SESSION['ID'];

                 $result = $studentController->changePassword($currentPassword, $newPassword, $repeatNewPassword, $studentID);
                        

                if ($result) {
                    echo '<p class="success_message">Your password has been successfully changed.</p>';
                } else {
                    throw new Exception('Failed to change your password. Please contact the system administrator.');
                }

        } 
            catch (Exception $e) 
            {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

    public function changeStaffPassword() 
    {
        if (isset($_POST['Submit']) && isset($_POST['Password']) && isset($_POST['NewPassword']) && isset($_POST['RepeatNewPassword']))
        {
            try 
            {
                $staffController = new StaffController();
               
                $currentPassword = $_POST['Password'];
                $newPassword = $_POST['NewPassword'];
                $repeatNewPassword = $_POST['RepeatNewPassword'];
                $staffID = $_SESSION['ID'];

                $result = $staffController->changePassword($currentPassword, $newPassword, $repeatNewPassword, $staffID);
                        
                if ($result) 
                {
                    echo '<p class="success_message">Your password has been successfully changed.</p>';
                } 
                else 
                {
                    throw new Exception('Failed to change your password. Please contact the system administrator.');
                }
            } 
            catch (Exception $e) 
            {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }
 

}

?>
