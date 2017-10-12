<?php
	session_start();
	
	$username = $_SESSION["username"];
	if($username == "") {
		header("Location: index.php?error=1");
		die();
	}
	
	$servername = 'localhost';
	$user = 'n00186780';
	$password = 'summer2017186780';
	$dbname = 'n00186780';
	
	// Create DB connection
	$mysql_access = new mysqli($servername, $user, $password, $dbname);
	
	// Verify connection
	if ($mysql_access_connect_errno)
		printf("Could not connect: %s\n", $mysql_access_connect_error());
	
	// Prepared statement to prevent SQL injection
	$stmt =  $mysql_access->prepare("SELECT * FROM Cars WHERE carID=?");
	$stmt->bind_param('i', $_GET["carID"]);
	$stmt->execute();
	$stmt->bind_result($carID, $carYear, $carMake, $carModel, $carOption, $carVIN, $carStyle, $carMileage, $carOrigin, $carWeight, $carHP);
	
	if($stmt === FALSE) {
		throw new Exception("Database Error [{$mysql_access->errno}] {$mysql_access->error}"); // TODO: better error handling
		$mysql_access->close();
		header("Location: main.php?status=1");
		die();
	}
	
	if(!($_GET["carID"])) {
		header("Location: main.php?status=1");
		die();
	}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Assignment 6</title>
<meta charset="utf-8"> 
<meta name="author" content="Stephen Hartman">
<meta name="description" content="COP 4813 ePortfolio" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
		<div class="col-md-8 col-md-offset-2 alert alert-success" style="text-align:center">
		<h3>
		<?php
			date_default_timezone_set('America/New_York');
			$datetime = date('m/d/Y h:i:s a');
			echo "Welcome back, $username!  ".$datetime;
			while($stmt->fetch()) {
		?>
		</h3>
		</div>
	</div>
	<form action="modify_process.php" method="post">
		<div class="row">
			<div class="col-md-6">
			<label for="year">Car Year</strong></label>
				<select id="year" name="carYear" value="<?php echo $carYear; ?>" required>
					<option selected="selected"><?php echo $carYear; ?></option>
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
				<input type="text" id="make" name="carMake" value="<?php echo $carMake; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="model">Car Model</label>
				<input type="text" id="model" name="carModel" value="<?php echo $carModel; ?>">
			</div>
			<div class="col-md-1 control-group">
				<label class="heading control-label" for="carOption[]">Options</label>
			</div>
			<div class="col-md-1">
				<label class="checkbox control-label" for="c1">Bluetooth</label>
				<input id="c1" name="carOption[]" type="checkbox" <?php if (isset($carOption) && $carOption=="Bluetooth" || $carOption=="Bluetooth,Leather") echo "checked";?> value="Bluetooth">
			</div>
			<div class="col-md-1">
				<label class="checkbox control-label" for="c2">Leather</label>
				<input id="c2" name="carOption[]" type="checkbox" <?php if (isset($carOption) && $carOption=="Leather" || $carOption=="Bluetooth,Leather") echo "checked";?> value="Leather">	
			</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="vin">Car VIN</label>
				<input type="text" id="vin" name="carVIN" value="<?php echo $carVIN; ?>">
			</div>
			<div class="col-md-6">
				<label for="style">Car Style</label>
				<input type="text" id="style" name="carStyle" value="<?php echo $carStyle; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="mileage">Car Mileage</label>
				<input type="number" id="mileage" name="carMileage" value="<?php echo $carMileage; ?>">
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
		<br/><br/>
		<div class="row">
			<div class="col-md-6">
				<label for="weight">Car Weight in pounds</label>
				<input type="number" id="weight" name="carWeight" value="<?php echo $carWeight; ?>">
			</div>
			<div class="col-md-6">
				<label for="hp">Car Horsepower</label>
				<input type="number" id="hp" name="carHP" value="<?php echo $carHP; ?>">
			</div>
		</div>
		<div class="row">
			<input type="hidden" name="carID" id="carID" value="<?php echo $carID; ?>">
			<?php
				} 
				$stmt->free_result();
				$stmt->close();
				$mysql_access->close();	
			?>
			<div class="col-md-4">
				<input style="width:100%" type="submit" value="Modify Record">
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-1 col-md-offset-11">
				<a style="width:100%" href="logout.php">Logout</a>
			</div>
		</div>
		<br/>
	</div>
	</form>
	<br/><br/>
</div>
</section>
<a class="top" href='#top'>Back to Top</a>
<footer>&copy; 2017 Stephen Hartman.  All rights reserved.</footer>
</body>
</html>