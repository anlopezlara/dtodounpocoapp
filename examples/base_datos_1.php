<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array();
$url = '/items/MLM602329981';
print '<!DOCTYPE html>';
print '<html>';
	print '<head>';
	print '<style>';
		print 'table {';
		print '    font-family: arial, sans-serif;';
		print '    border-collapse: collapse;';
		print '    width: 100%;';
		print '}';

		print 'td, th {';
		print '    border: 1px solid #dddddd;';
		print '    text-align: left;';
		print '    padding: 8px;';
		print '}';

		print 'tr:nth-child(even) {';
		print '    background-color: #dddddd;';
		print '}';
		print '</style>';
	print '</head>';
	
	print '<body>';
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
					  WHERE ref is not null";
					 //WHERE ref in ('T0057','T0338')";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				print '<table class="border" width="100%">';
				while($row = $result->fetch_assoc()) {
					print "<tr>";
					print "<td>".$row["ref"]. "</td><td>" . $row["accountancy_code_sell"]." </td><td>".$row["label"]." </td><td>" . $row["price"]."</td><td>" . $row["stock"]."</td>";
					print "</tr>";
				}
				print '</table>';
			} else {
				print "0 results";
			}
		}
		if(isset($_POST['submit']))
		{
		   display($servername,$username,$password);
		} 
	print '</body>';
print '</html>';