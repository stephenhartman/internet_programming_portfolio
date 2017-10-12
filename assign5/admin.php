<?php
	session_start();
	
	$username = $_SESSION["username"];
	if ($username == "") {
		header("Location: index.php?error=1");
		die();
	}
	
	$ticker = $_POST["ticker"];
	$stockNum = $_POST["stockNum"];
	
	if ($_POST["change"] == "add")
		$change = "add";
	elseif ($_POST["change"] == "modify")
		$change = "modify";
	elseif ($_POST["change"] == "delete")
		$change = "delete";
	$datetime = date('m/d/Y h:i:s a');
	
	function addStock($tick, $stockNum, $totalValue) {
		$datetime = date('m/d/Y h:i:s a');
		
		if ($stockNum < "1") {
			header("Location: stock.php?error=1&display=1");
			die();
		}

		$csvFile = file("http://finance.yahoo.com/d/quotes.csv?s=$tick&f=sl1d1t1c1ohgv&e=.csv");
		$data = [];
		foreach ($csvFile as $line) {
			$data = str_getcsv($line);
		}
		implode(",",$data);
		if ($data[1] !== "N/A") {
			$value = round(($data[1] * $stockNum), 2);
			$fp = fopen("userdata.dat", "a");
			fwrite($fp, "Ticker: $data[0] | Price: $data[1] | # of Shares: $stockNum | Value:  $value | Entered on: $datetime\n");
			fclose($fp);
		} else {
			header("Location: stock.php?error=1&display=1");
		}
	}
	
	function modifyStock($tick, $stockNum) {
		$datetime = date('m/d/Y h:i:s a');
		
		if ($stockNum < "1") {
			header("Location: stock.php?error=1&display=1");
			die();
		}
		$csvFile = file("http://finance.yahoo.com/d/quotes.csv?s=".$tick."&f=sl1d1t1c1ohgv&e=.csv");
		$data = [];
		foreach ($csvFile as $line) {
			$data = str_getcsv($line);
		}
		implode(",",$data);
		$value = round(($data[1] * $stockNum), 2);
		$fc = file("userdata.dat");
		$fp = fopen("userdata.dat", "w");
		foreach($fc as $line) {
			if (!strstr($line, $tick))
				fputs($fp, $line);
			else
				fwrite($fp, "Ticker: $data[0] | Price: $data[1] | # of Shares: $stockNum | Value:  $value | Entered on: $datetime\n");
			}
		fclose($fp);
	}
	
	function deleteStock($tick) {
		$fc = file("userdata.dat");
		$fp = fopen("userdata.dat", "w");
		foreach($fc as $line) {
			if (!strstr($line, $tick))
				fputs($fp, $line);
		}
		fclose($fp);
	}
	

	if($change == "add")
		addStock($ticker, $stockNum, $totalValue);
	elseif ($change == "modify")
		modifyStock($ticker, $stockNum);
	elseif ($change == "delete")
		deleteStock($ticker);
	else
		header("Location: stock.php?error=1&display=1");
	header("Location: stock.php?display=1");
?>
