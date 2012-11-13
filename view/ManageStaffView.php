<?php

require_once('../inc/config.php');
require_once('../controller/SessionManager.php');
require_once('../controller/staffcontroller.php');
require_once('../model/staffModel.php');

class ManageStaffView{

    public function validateSession() {
        $sessionManager = new SessionManager();
        
        if ($sessionManager->authenticateReservationSession()) {
            header('Location: ../reservation');
            exit;
        }

        if (!$sessionManager->authenticateSession() || !$sessionManager->authenticateAdminSession()) {
            header('Location: ../index.php');
            exit;
        }
    }

	public function upgradeStaff(){
		if(isset($_POST['upgrade'])){
			try{
				$staffController = new StaffController();
				$staffController ->promoteToSuperAdmin($_POST['staffID']);
				echo '<p class="success_message">' . $_POST['staffID'] . ' has been upgraded to Admin status.</p>';
			}
			catch(Exception $e){
				echo'<p class = "error_message">'.$e->getMessage().'</p>';
			}
		}
	}

	public function downgradeStaff(){
		if(isset($_POST['downgrade'])){
			try{
				$staffController = new StaffController();
				$staffController->demoteToNormalAdmin($_POST['staffID']);
				echo '<p class="success_message">' . $_POST['staffID'] . ' has been downgraded to Admin status.</p>';
            } catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
			}
		}
	public function removeStaff() {
        if (isset($_POST['delete'])) {
            try {
                $staffController = new StaffController();
                $staffController->removeAdmin($_POST['staffID']);

                echo '<p class="success_message">Admin has been removed.</p>';
            } catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

    public function showAllStaff() {
        try {
            $staffController = new StaffController();
            $result = $staffController->getAllStaff();

            if ($result > 0) {
                echo '<table>';
                echo '<thead>';
                if (isset($_SESSION['SuperAdmin']) && $_SESSION['SuperAdmin']) {
                    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Status</th><th>Upgrade/Downgrade</th><th>Delete</th></tr>';
                } else {
                    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Status</th></tr>';
                }
                echo '</thead>';
                echo '<tbody>';
                for ($i = 0; $i < sizeof($result); $i++) {
                    echo '<tr>';
                    if (isset($_SESSION['SuperAdmin']) && $_SESSION['SuperAdmin']) {
                        echo '<form action="manage_admin.php" method="post">';
                        echo '<td><input type="text" value="' . $result[$i]['StaffID'] . '" readonly="readonly" name="staffID" /></td>';
                    } else {
                        echo '<td>' . $result[$i]['StaffID'] . '</td>';
                    }
                    
                    echo '<td>' . $result[$i]['StaffFirstName'] . '</td>';
                    echo '<td>' . $result[$i]['StaffLastName'] . '</td>';
                    echo '<td>' . (($result[$i]['SuperAdmin'] == 0) ? 'Admin' : 'Super Admin') . '</td>';
                    if (isset($_SESSION['SuperAdmin']) && $_SESSION['SuperAdmin']) {
                        echo '<td><input type="submit"' . (($result[$i]['SuperAdmin'] == 0) ? ' name="upgrade" value="Upgrade"' : ' name="downgrade" value="Downgrade"') . ' /></td>';
                        echo '<td><input type="submit" name="delete" value="Delete" /></td>';
                        echo '</form>';
                    }
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No administrator is available.</p>';
            }
        } catch (Exception $e) {
            echo '<p class="error_message">' . $e->getMessage() . '</p>';
        }
    }

}

?>		

		

