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
<link rel="stylesheet" href="../styles.css"/>
<link rel="icon" type="image/x-icon" href="../image/favicon.ico">
</head>
<body>
<header>
<h1>ePortfolio for COP 4813: Internet Programming</h1>
</header>
  <h2>Log in to Stock Portfolio Manager</h2>
<nav>
<ul>
<li><a href="../index.html">Home</a></li>
<!--<li><a class="active" href ="index.html">Assignment 1</a></li>-->
</ul>
</nav>
<section>
	<div class="container" style="width:50%">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form action="authenticate.php" method="post">
				<label for="user">Username</label>
				<input type="text" id="user" name="username" required>
				<label for="pass">Password</label>
				<input type="password" id="pass" name="password" required>
				<div><strong>
				<?php
					$error = $_GET["error"];
					if($error == 1)
						echo "Invalid credentials.";
					elseif($error == 2)
						echo "Successfully logged out.";
				?>
				</strong></div>
				<div style="text-align:center; width:50%">
				<input style="width:100%" type="submit" value="Login">
				</div>
				</form>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
</section>
<a class="top" href='#top'>Back to Top</a>
<footer>&copy; 2017 Stephen Hartman.  All rights reserved.</footer>
</body>
</html>
