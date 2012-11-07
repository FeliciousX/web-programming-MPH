<?php

require_once('Controller/SessionManager.php');
require_once('Controller/AdminController.php');
require_once('Controller/UserController.php');

require_once('Model/AdminModel.php');
require_once('Model/UserModel.php');


/**
 * Description of RegistrationView
 *
 * @author Benedict Khoo
 * @version 2012-06-24
 * @package view
 */
class RegistrationView {

    public function validateSession() {
        $sessionManager = new SessionManager();
        
        // if ($sessionManager->authenticateReservationSession()) {
        //     header('Location: reservation/index.php');
        //     exit;
        // }
        
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

    /**
     * @author Calvin
     * @author Benedict Khoo 
     */
    public function validateRegistrationData() {
        if (isset($_POST['Register'])) {
            try {
               

                $userController = new UserController();
                $userController->register($_POST['Username'], $_POST['FirstName'], $_POST['LastName'], $_POST['Password'], $_POST['RepeatPassword'], $_POST['Captcha']);

                echo '<p class="success_message">Registration is successful.<br />Please check your Swinburne email for instructions on how to activate your account. Please check your junk folder.</p>';
            } 
            catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

    /**
     * @author Marshal Daniel
     * @author Benedict Khoo
     * 
     * @throws Exception 
     */
    public function validateLoginData() {
        if (isset($_POST['Login']) && isset($_POST['Username']) && isset($_POST['Password'])) {
            try {
                $username = $_POST['Username'];
                $password = $_POST['Password'];

                $userController = new UserController();
                $adminController = new AdminController();
                $sessionManager = new SessionManager();
                

                $user = $userController->authenticateUser($username, $password);
                $validAdmin = $adminController->authenticateAdmin($username, $password);

                mt_srand(time());
                $name = md5(mt_rand(0, mt_getrandmax()));

               if (sizeof($user) == 1 && $user['ActivationStatus'] == 0) {
                    throw new Exception('<a href="activate.php">Please activate you account first.<br />Click here to activate your account.</a>');
                }

                if (!is_null($validAdmin)) {
                    $superAdminStatus = $validAdmin[0]['SuperAdmin'];

                    $sessionManager->startSession($name, 1, $username, $superAdminStatus);
                    header('Location: admin/index.php');
                    exit;
                }

                throw new Exception('Invalid username or password.');
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