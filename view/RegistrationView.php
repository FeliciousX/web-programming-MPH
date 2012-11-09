<?php

require_once('controller/SessionManager.php');
require_once('controller/StaffController.php');
require_once('controller/StudentController.php');
require_once('model/StudentModel.php');
require_once('model/StaffModel.php');


/**
 * Description of RegistrationView
 *
 * @author LiewKitLoong
 * @version 2012-11-08
 * @package view
 */
class RegistrationView {

    public function validateSession() {
        $sessionManager = new SessionManager();
        
        if (isset($_SESSION['ID']) && !empty($_SESSION['ID'])) {
            if (isset($_SESSION['Admin']) && $_SESSION['Admin']) {
                header('Location: admin/index.php');
                exit;
            } else {
                header('Location: user/index.php');
                exit;
            }
        }
    }


    public function validateStudentRegistrationData() {
        if (isset($_POST['Register'])) {
            try {
               

                $studentController = new StudentController();
                $studentController->register($_POST['Username'], $_POST['FirstName'], $_POST['LastName'], $_POST['Password'], $_POST['RepeatPassword'], $_POST['Captcha']);

                echo '<p class="success_message">Registration is successful.<br />Please check your Swinburne email for instructions on how to activate your account. Please check your junk folder.</p>';
            } 
            catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

        public function validateStaffRegistrationData() {
        if (isset($_POST['Register'])) {
            try {
               

                $staffController = new StaffController();
                $staffController->register($_POST['Username'], $_POST['FirstName'], $_POST['LastName'], $_POST['Password'], $_POST['RepeatPassword'], $_POST['Captcha']);

                echo '<p class="success_message">Registration is successful.<br />Please check your Swinburne email for instructions on how to activate your account. Please check your junk folder.</p>';
            } 
            catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

    /**
     * 
     * @throws Exception 
     */
    public function validateLoginData() {
        if (isset($_POST['Login']) && isset($_POST['Username']) && isset($_POST['Password'])) {
            try {
                $username = $_POST['Username'];
                $password = $_POST['Password'];

                $studentController = new StudentController();
                $staffController = new StaffController();
                $sessionManager = new SessionManager();
                

                $student = $studentController->authenticateUser($username, $password);
                $validstaff = $staffController->authenticateStaff($username, $password);

                if ($student || $validstaff) {
                     mt_srand(time());
                    $name = md5(mt_rand(0, mt_getrandmax()));
                     if (sizeof($student) == 1 && $student['ActivationStatus'] == 1) {

                        $sessionManager->startSession($name, 0, $username, 0);
                        header('Location: user/index.php');
                        exit;
                    }

                   elseif (sizeof($student) == 1 && $student['ActivationStatus'] == 0) {
                        throw new Exception('<a href="activate.php">Please activate you account first.<br />Click here to activate your account.</a>');
                    }
                    
                    if( !is_null($validstaff))
                    {
                        $superAdminStatus = $validstaff['SuperAdmin'];
                    if($superAdminStatus  == 1)
                    {
                         
                        $sessionManager->startSession($name, 1, $username, $superAdminStatus);
                        header('Location: admin/index.php');
                        exit;
                    }
                    elseif($superAdminStatus  == 0)
                    {
                         if (sizeof($validstaff) == 1 & $validstaff['ActivationStatus'] == 1) 
                        {

                        $sessionManager->startSession($name, 0, $username, 0);
                        header('Location: user/index.php');
                        exit;
                        }
                        else
                        {
                            throw new Exception('<a href="activate.php">Please activate you account first.<br />Click here to activate your account.</a>');
                        }
                    }
                }               
            }
            elseif (!$student && !$validstaff) {                
                throw new Exception('Invalid username or password.');
            }
            } catch (ErrorException $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            } catch (mysqli_sql_exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            } catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

}

?>