<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array();
$url = '/items/MLM602329981';
print '<!DOCTYPE html>';
print '<html>';
	print '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  ';
	print '    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->';
	print '</form>';

	function display($servername_,$username_,$password_)
	{
		$conn = new mysqli($servername_, $username_, $password_);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT ref, label, price, accountancy_code_sell, stock
				  FROM i3120427_doli1.doli_product
				 WHERE ref in ('T0057','T0338')";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			print '<table class="border" width="100%">';
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$row["ref"]. "</td><td>" . $row["accountancy_code_sell"]." </td><td>".$row["label"]." </td><td>" . $row["price"]."</td><td>" . $row["stock"]."</td>";
				echo "</tr>";
			}
			print '</table>';
		} else {
			echo "0 results";
		}
	}
	if(isset($_POST['submit']))
	{
	   display($servername,$username,$password);
	} 
print '</html>';