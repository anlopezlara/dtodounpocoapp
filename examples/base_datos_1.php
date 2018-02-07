<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array();
$url = '/items/MLM602329981';

print '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  ';
print '    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->';
print '</form>';

$servername = "www.d-todounpoco.com.mx";
$username = "anlopez";
$password = "Azteca02";

function display()
{
	echo "Prueba_11111111111";
	$servername = "www.d-todounpoco.com.mx";
	$username = "anlopez";
	$password = "Azteca02";

	#$conn = new mysqli("www.d-todounpoco.com.mx", "anlopez", "Azteca02");
	$conn = new mysqli($servername, $username, $password);
	echo "Prueba_2";
	if ($conn->connect_error) {
		echo "Prueba_3";
		die("Connection failed: " . $conn->connect_error);
		echo "Prueba_4";
	} 
	echo "Prueba_5";

	$sql = "SELECT ref, label, price, accountancy_code_sell, stock
			  FROM i3120427_doli1.doli_product
			 WHERE ref in ('T0057','T0338')";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<p>ref: " . $row["ref"]. " - label: " . $row["label"]. " " . " - price: " . $row["price"]. " - accountancy_code_sell: " . $row["accountancy_code_sell"]. " - stock: " . $row["stock"]. "</p>";
		}
	} else {
		echo "0 results";
	}
}
if(isset($_POST['submit']))
{
   display();
} 