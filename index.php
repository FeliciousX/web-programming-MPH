<?php
	session_start();
	if(!isset($_GET['sportsType']))
		header("Location:index.php?sportsType=Basketball");
	require_once('view/IndexView.php');
	$indexView = new IndexView();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SSFO | Home</title>
	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->

	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
	
	<!-- Your styles -->
	<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
	<script type="text/javascript">
	function setSelections()
	{
	    document.sportsForm.sportsType.value = getQueryValue("sportsType");
	};

	function getQueryValue(key)
	{
	    var queryString = window.location.search.substring(1);
	    var queryParams = queryString.split("&");
	    for(var i = 0; i < queryParams.length; i++)
	    {
	    	if(queryParams[i].indexOf("=") > 0)
	    	{
	    		var keyValue = queryParams[i].split("=");
	    		if(keyValue[0] == key)
	    		{
	    			return keyValue[1];
	    		}
	    	}
	    }

	    return null;
	}
	</script>
</head>

<body onload="setSelections();">
<?php include 'inc/header.php' ?>
<?php include 'inc/navbar.php' ?>
<div class="container">
	<div class="row selection">
		<div class="twelvecol last centerObjects">
			<fieldset>
				<legend>Sports Type</legend>
			<form name="sportsForm" action="index.php" method="get">
			<p>
			<select id="sportsType" name="sportsType">
			    <option value="Basketball">Basketball</option>
			    <option value="Badminton">Badminton</option>
			    <option value="TableTennis">Table Tennis</option>
			    <option value="Squash">Squash</option>
			    <option value="MultistoreyCarpark">Multistorey Carpark</option>
			</select>
			<input type="submit" value="Submit" class="button" />
			</p>
			</form>
			</fieldset>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="twelvecol last">
			<fieldset class="schedule">
				<legend class="centerObjects">Schedule of the Week</legend>
				<?php 
					if(!isset($_GET['sportsType']))
						$_GET['sportsType'] = "Basketball";
					$indexView->displayTable($_GET['sportsType']); 
				?>
			</fieldset>
		</div>
	</div>
</div>

</body>

</html>