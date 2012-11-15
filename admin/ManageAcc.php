<?php
	require_once('../view/ManageAccView.php');
	$ManageAccView = new ManageAccView();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>
        	Manage Students
        </title>
 </head>
 <body>
 	<h2>Manage Students</h2>
 	<h2>Search</h2>
 	 	<form action="ManageAcc.php" method="post">
      		 <fieldset class="form">
	             <label class="form">Search:</label>
	             <input type="text" name="searchItem" />
	             <select name="type">
	            	<option value="StudentID" selected="selected">Student ID</option>
	              	<option value="StudentFirstName">First Name</option>
	              	<option value="StudentLastName">Last Name</option>
	              </select>
	              <input class="form" type="submit" name="showAll" value="Show All" />
	               <input class="form" type="submit" name="search" value="Search" />
              </fieldset>
     </form> 
 	<h2>Account</h2>
 	<?php
        $ManageAccView->activate();
        $ManageAccView->deactivate();
        $ManageAccView->delete();
        if (isset($_POST['search'])) {
            $ManageAccView->search();
        } else {
         	$ManageAccView->showStudent();
      	}
     ?>

    </body>
</html> 

