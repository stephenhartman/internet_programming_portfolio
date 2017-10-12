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
<title>Assignment 5</title>
<meta charset="utf-8"> 
<meta name="author" content="Stephen Hartman">
<meta name="description" content="COP 4813 ePortfolio" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
</script>
<link rel="stylesheet" href="../styles.css"/>
<link rel="icon" type="image/x-icon" href="../image/favicon.ico">
</head>
<body>
<header>
<h1>ePortfolio for COP 4813: Internet Programming</h1>
</header>
<h2>Stock Portfolio Manager</h2>
<section>
<div class="container" style="width:50%">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 alert alert-success" style="text-align:center">
		<h3>
		<?php
			date_default_timezone_set('America/New_York');
			$datetime = date('m/d/Y h:i:s a');
			echo "Welcome back, $username!  ".$datetime;
		?>
		</h3>
		</div>
	</div>
	<form action="admin.php" method="post">
		<div class="row">
			<div class="col-md-2"></div>
				<div class="col-md-8">
					<label for="ticker">Enter Stocker Ticker Symbol</label>
					<input type="text" id="ticker" name="ticker" required>
					<label for="stockNum">Enter quantity</label>
					<input type="number" id="stockNum" name="stockNum">
					<div>
						<?php
							$error = $_GET["error"];
							if($error == 1)
								echo "<strong>Invalid entry.</strong>";
						?>
					</div>
				</div>
		</div>
		<div class ="row">
		<div class="col-md-6 col-md-offset-2">
			<label for="r1">Add Stock</label>
			<input id="r1" name="change" type="radio" <?php if (isset($change) && $change=="add") echo "checked";?> value="add">
			<label for="r2">Modify Stock</label>
			<input id="r2" name="change" type="radio" <?php if (isset($change) && $change=="modify") echo "checked";?> value="modify">
			<label for="r3">Delete Stock</label>
			<input id="r3" name="change" type="radio" <?php if (isset($change) && $change=="delete") echo "checked";?> value="delete">
			</div>
			<div class="col-md-2">
			<input style="width:100%" type="submit" value="submit">
			</div>
			<div class="col-md-2">
			<a style="width:100%" href="logout.php">Logout</a>
			</div>
		</div>
	</form>
	<br/><br/>
	<div>
		<div class="row">
		<div class="col-md-12" style="text-align:center">
		<?php
			$display = $_GET["display"];
			if ($display == 1) {
				echo '<table class="table table-hover">';
				$fc = file("userdata.dat");
				foreach($fc as $line) {
					$lineArray = explode(' ', $line);
					$totalValue += $lineArray[13];
					if (!strstr($line, $username))
						echo '<tr><td>'.$line.'</td></tr>';
				}
				echo '<tr><td>Total Value: $'.$totalValue.'</td></tr>';
				echo '</table>';
			}
		?>
	</div>
</div>
</section>
<a class="top" href='#top'>Back to Top</a>
<footer>&copy; 2017 Stephen Hartman.  All rights reserved.</footer>
</body>
</html>