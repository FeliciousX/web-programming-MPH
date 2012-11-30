<?php
require_once('model/StaffModel.php');
require_once('model/StudentModel.php');
require_once('StaffController.php');
require_once('StudentController.php');
require_once('inc/config.php');

class ActivationController
{
	public function activateAccount() {
        if (isset($_GET['activate'])) {
            try {
                $staffController = new StaffController();
                $studentController = new StudentController();

                $staff = $staffController->getStaff($_GET['userID']);
                $student = $studentController->getStudent($_GET['userID']);

                if ($staff == false && $student == false) {
                	throw new Exception('Invalid ID');
                }

                if ($staff) {
                	$staffController->activate($_GET['userID'], $_GET['code']);
                }
                
                if ($student) {
                	$studentController->activate($_GET['userID'], $_GET['code']);
                }

                echo '<p class="success_message">Account activation is successful. You can now login.</p>';
            } catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }
}

?>