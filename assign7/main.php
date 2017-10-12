<?php
	session_start();
	
	$username = $_SESSION["username"];
	if($username == "") {
		header("Location: index.php?error=1");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Assignment 7</title>
<meta charset="utf-8"> 
<meta name="author" content="Stephen Hartman">
<meta name="description" content="COP 4813 ePortfolio" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="showOrigin.js"></script>
<link rel="stylesheet" href="../styles.css"/>
<link rel="icon" type="image/x-icon" href="../image/favicon.ico">
</head>
<body>
<header>
<h1>ePortfolio for COP 4813: Internet Programming</h1>
</header>
<h2>Car Inventory Manager</h2>
<section>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<form>
				<label for "selectOrigin">Select a Country of Origin</label>
				<select name="origin" id="selectOrigin" onchange="showOrigin(this.value)">
					<option value="">Select an Option</option>
					<option value="*">All</option>
					<option value="USA">USA</option>
					<option value="Japan">Japan</option>
					<option value="Germany">Germany</option>
				</select>
			</form>
		</div>
		<div class="col-md-6 alert alert-success" style="text-align:center">
		<h3>
		<?php
			date_default_timezone_set('America/New_York');
			$datetime = date('m/d/Y h:i:s a');
			echo "Welcome back, $username!  ".$datetime;
		?>
		</h3>
		</div>
		<div class="col-md-3">
			<nav>
				<ul>
				<li style="width:100%"><a href="../image/Assign6ERD.jpg" target="_blank" title="Assignment 7 ERD">Assignment 7 ERD</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<form action="add.php" method="post" name="carData">
		<div class="row">
			<div class="col-md-6">
			<label for="year">Car Year</label>
				<select id="year" name="carYear" value="" required>
					<option selected="selected">Car Year</option>
					<option value="2018">2018</option>
					<option value="2017">2017</option>
					<option value="2016">2016</option>
					<option value="2015">2015</option>
					<option value="2014">2014</option>
					<option value="2013">2013</option>
					<option value="2012">2012</option>
					<option value="2011">2011</option>
					<option value="2010">2010</option>
					<option value="2009">2009</option>
					<option value="2008">2008</option>
					<option value="2007">2007</option>
					<option value="2006">2006</option>
					<option value="2005">2005</option>
					<option value="2004">2004</option>
					<option value="2003">2003</option>
					<option value="2002">2002</option>
					<option value="2001">2001</option>
					<option value="2000">2000</option>
				</select>
			</div>
			<div class="col-md-6">
				<label for="make">Car Make</label>
				<input type="text" id="make" name="carMake">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="model">Car Model</label>
				<input type="text" id="model" name="carModel">
			</div>
			<div class="col-md-1 control-group">
				<label class="heading control-label" for="carOption[]">Options</label>
			</div>
			<div class="col-md-1">
				<label class="checkbox control-label" for="c1">Bluetooth</label>
				<input id="c1" name="carOption[]" type="checkbox" value="Bluetooth">
			</div>
			<div class="col-md-1">
				<label class="checkbox control-label" for="c2">Leather</label>
				<input id="c2" name="carOption[]" type="checkbox" value="Leather">
			</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="vin">Car VIN</label>
				<input type="text" id="vin" name="carVIN">
			</div>
			<div class="col-md-6">
				<label for="style">Car Style</label>
				<input type="text" id="style" name="carStyle">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="mileage">Car Mileage</label>
				<input type="number" id="mileage" name="carMileage">
			</div>	
			<div class="col-md-1 control-group">
				<label class="heading control-label" for="carOrigin">Car Origin</label>
			</div>
			<div class="col-md-1">
				<label class="radio control-label" for="r1">USA</label>
				<input id="r1" name="carOrigin" type="radio" <?php if (isset($carOrigin) && $carOrigin=="USA") echo "checked";?> value="USA" required>
			</div>
			<div class="col-md-1">
				<label class="radio control-label" for="r2">Japan</label>
				<input id="r2" name="carOrigin" type="radio" <?php if (isset($carOrigin) && $carOrigin=="Japan") echo "checked";?> value="Japan">	
			</div>
			<div class="col-md-1">		
				<label class="radio control-label" for="r3">Germany</label>
				<input id="r3" name="carOrigin" type="radio" <?php if (isset($carOrigin) && $carOrigin=="Germany") echo "checked";?> value="Germany">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="weight">Car Weight in pounds</label>
				<input type="number" id="weight" name="carWeight">
			</div>
			<div class="col-md-6">
				<label for="hp">Car Horsepower</label>
				<input type="number" id="hp" name="carHP">
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2" style="text-align:center">
				<?php
					$status = $_GET["status"];
					if($status == 1)
						echo "<strong>Invalid entry.</strong>";
					elseif($status == 2)
						echo "<strong>Car successfully deleted.</strong>";
					elseif($status == 3)
						echo "<strong>Car successfully added.</strong>";
					elseif($status == 4)
						echo "<strong>Car successfully modified.</strong>";
				?>
			</div>
		</div>
		<div class ="row">
			<div class="col-md-4">
				<input style="width:100%" type="submit" value="Submit">
			</div>
			<div class="col-md-4">
				<input style="width:100%" type="button" value="Delete" onClick="deleteRecord()">
			</div>
			<div class="col-md-4">
				<input style="width:100%" type="button" value="Modify" onClick="modifyRecord()">
			</div>
		</div>
	</form>
	<br/>
	<div class="row">
		<div class="col-md-1 col-md-offset-11">
			<a style="width:100%" href="logout.php">Logout</a>
		</div>
	</div>
	<br/>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div id="output"></div>
			</div>
		</div>
	</div>
</div>
</section>
<a class="top" href='#top'>Back to Top</a>
<footer>&copy; 2017 Stephen Hartman.  All rights reserved.</footer>
</body>
</html>