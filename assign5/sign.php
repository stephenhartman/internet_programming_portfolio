<?php
include_once('class.yahoostock.php');
 
$objYahooStock = new YahooStock;
 

$objYahooStock->addFormat("snl1d1t1cv"); 
 
//$objYahooStock->addStock("msft");






	//Get variables 
	$name = $_POST["name"];
	$delete = $_POST["delete"];
	$quantity =  $_POST["quantity"];
	$modifyName =  $_POST["modifyName"];
	$modifyQuantity =  $_POST["modifyQuantity"];
 
 
 if( !empty($name) ){
$objYahooStock->addStock($_POST["name"]);
}
if( !empty($modifyName) ){	
$objYahooStock->addStock($_POST["modifyName"]);
}

foreach( $objYahooStock->getQuotes() as $code => $stock)
{
    ?>
    Code: <?php echo $stock[0]; ?> <br />
    Name: <?php echo $stock[1]; ?> <br />
    Last Trade Price: <?php echo $stock[2]; ?> <br />
    Last Trade Date: <?php echo $stock[3]; ?> <br />
    Last Trade Time: <?php echo $stock[4]; ?> <br />
    Change and Percent Change: <?php echo $stock[5]; ?> <br />
    Volume: <?php echo $stock[6]; ?> <br /><br />
	Quantity: <?php echo $stock[7]; ?> <br /><br />
    <?php
}

 
	//$city = $_POST["$stock[0]"];
	//$website = $_POST["website"];
	//$today = date("m.d.y");

	//Create a file pointer
	$fp = fopen("information.dat", "a");

	//Wrte the data
	//fwrite($fp, "$name|$city|$website|$today\n");
	if( !empty($name) && !empty($quantity)   ){
	fwrite($fp, "$stock[0]|$quantity|$stock[1]|$stock[2]|$stock[3]|$stock[4]|$stock[5]|$stock[6]|\n");
	}
	
	
	
	
if( !empty($modifyName) ){	
$key = "$modifyName";

//load file into $fc array

$fc=file("information.dat");

//open same file and use "w" to clear file

$f=fopen("information.dat","w");

//loop through array using foreach

foreach($fc as $line)
{
      if (!strstr($line,$key)) //look for $key in each line
            fputs($f,$line); //place $line back in file
					
}
fclose($f);
}		
	if( !empty($modifyQuantity)   ){
	fwrite($fp, "$stock[0]|$modifyQuantity|$stock[1]|$stock[2]|$stock[3]|$stock[4]|$stock[5]|$stock[6]|\n");
	}	
	
	
	

	
if( !empty($delete) ){	
$key = "$delete";

//load file into $fc array

$fc=file("information.dat");

//open same file and use "w" to clear file

$f=fopen("information.dat","w");

//loop through array using foreach

foreach($fc as $line)
{
      if (!strstr($line,$key)) //look for $key in each line
            fputs($f,$line); //place $line back in file
}
fclose($f);
}	

	
	//Close the file
	fclose($fp);

	//Server-side redirct
	header("Location: example2.php");

?>
