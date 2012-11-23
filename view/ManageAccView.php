<?php

require_once('inc/config.php');
require_once('controller/studentcontroller.php');
require_once('controller/SessionManager.php');
require_once('model/studentmodel.php');

class ManageAccView{

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

	public function search(){
		if(isset($_POST['search'])){
			try{
				$studentController = new StudentController();
				$sResult = array();

				if(strcmp($_POST['type'],'StudentID')==0){
					$sResult = $studentController -> getAllStudentByID($_POST['searchItem']);	
				}
				elseif(strcmp($_POST['type'],'StudentFirstName')==0){
					$sResult = $studentController->getAllStudentByFirstName($_POST['searchItem']);
				}
                elseif(strcmp($_POST['type'],'StudentLastName')==0){
                    $sResult = $studentController->getAllStudentByLastName($_POST['searchItem']);
                }
				else{
					throw new Exception('Invalid search criteria');
				}

				if(sizeof($sResult)> 0){
					echo'<table>';
					echo'<thead><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Account Status</th><th></th><th></th></tr></thead>';
					echo'<tbody>';
					for($i = 0;$i<sizeof($sResult);$i++){
					echo'<tr>';
					echo'<form action = "manage_acc.php" method = "post">';
					echo '<td><input type="text" value="' . $sResult[$i]['StudentID'] . '" name="studentID" readonly="readonly" /></td>';
                    echo '<td>' . $sResult[$i]['StudentFirstName'] . '</td>';
                    echo '<td>' . $sResult[$i]['StudentLastName'] . '</td>';
                    echo '<td' . ($sResult[$i]['ActivationStatus'] == 1 ? ' class="success_message">Activated' : ' class="error_message">Not Activated') . '</td>';
                    echo '<td><input onclick="confirmDialog();" type="submit" value="' . ($sResult[$i]['ActivationStatus'] == 1 ? 'Deactivate" name="deactivate"' : 'Activate" name="activate"') . ' /></td>';
                    echo '<td><input onclick="confirmDialog();" type="submit" name="delete" value="Remove" /></td>';
                    echo '</form>';
                    echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } 
                else {
                    echo '<p>No students in the database.</p>';
                }
            	}catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';


					}
				}
			}
	public function showStudent() {
        $studentController = new StudentController();
        $sList = $studentController->getAllStudent();

        if (sizeof($sList) > 0) {
            echo '<table>';
            echo '<thead><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Account Status</th><th></th><th></th></tr></thead>';
            echo '<tbody>';
            for ($i = 0; $i < sizeof($sList); $i++) {
                echo '<tr>';
                echo '<form action="manage_acc.php" method="post">';
                echo '<td><input type="text" value="' . $sList[$i]['StudentID'] . '" name="studentID" readonly="readonly" /></td>';
                echo '<td>' . $sList[$i]['StudentFirstName'] . '</td>';
                echo '<td>' . $sList[$i]['StudentLastName'] . '</td>';
                echo '<td' . ($sList[$i]['ActivationStatus'] == 1 ? ' class="success_message">Activated' : ' class="error_message">Not Activated') . '</td>';
                echo '<td><input onclick="confirmDialog();" type="submit" value="' . ($sList[$i]['ActivationStatus'] == 1 ? 'Deactivate" name="deactivate"' : 'Activate" name="activate"') . ' /></td>';
                echo '<td><input onclick="confirmDialog();" type="submit" name="delete" value="Remove" /></td>';
                echo '</form>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No students in the database.</p>';
        }
    }
		
    public function activate(){
    	if(isset($_POST['activate'])){
    		try{
    			$studentController = new StudentController();
    			$studentController->activateUser($_POST['studentID']);

    			echo'<p class ="success_message">Account actived.</p>';

    		  }
            catch (Exception $e){
    			echo'<p class="error_message">'.$e->getMessage().'</p>';
    		}
    	}
    }

    public function deactivate() {
        if (isset($_POST['deactivate'])) {
            try {
               $studentController = new StudentController();
                $studentController->deactivateUser($_POST['studentID']);

                echo '<p class="success_message">Account deactivated.</p>';
            } catch (Exception $e) {
                echo '<p class="error_message">' . $e->getMessage() . '</p>';
            }
        }
    }

    public function delete(){
    	if(isset($_POST['delete'])){
    		try{
    			$studentController = new StudentController();
    			$studentController->removeStudent($_POST['studentID']);
    			echo'<p class="success_message">Account deleted.</p>';
    		}catch (Exception $e){
    			echo'<p class = "error_message">'.$e->getMessage().'</p>';
    		}
    	}
    }
}


?>