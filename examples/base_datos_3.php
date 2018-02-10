<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array();
$url = '/items/MLM';
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

		function display($servername_,$username_,$password_,$meli_,$params_,$url_)
		{
			$conn = new mysqli($servername_, $username_, $password_);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT *#ref, label, price, accountancy_code_sell, stock
					  FROM i3120427_doli1.doli_product
					 WHERE accountancy_code_sell != ''
					   AND ref in ('T0057','T0338')";
					 // AND substring(ref,1,1) = 'T'";
					 //WHERE ref in ('T0057','T0338')";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				print '<table class="border" width="100%">';
				print "<td>ID Dolibar</td>
				       <td>ID MercLibre</td>
					   <td>Descripción</td>
					   <td>Precio Dolibar</td>
					   <td>Stock Dolibar</td>
					   <td>Precio ML</td>
					   <td>Cantidad ML</td>
					   <td>Estatus ML</td>";
				while($row = $result->fetch_assoc()) {
					
					$resultml = $meli_->get($url_.$row["accountancy_code_sell"], $params_);
					foreach ( $resultml[body] as $key => &$value )
					{
						if ($key == 'price') {
							$precio = $value;
						}
						if ($key == 'available_quantity') {
							$cantidad = $value;
						}
						if ($key == 'status') {
							$estatus = $value;
						}
					}
					
					print "<tr>";
					print "<td>".$row["ref"]                  ."</td>
					       <td>".$row["accountancy_code_sell"]."</td>
						   <td>".$row["label"]                ."</td>
						   <td>".$row["price"]                ."</td>
						   <td>".$row["stock"]				  ."</td>
						   <td>".$precio				  	  ."</td>
						   <td>".$cantidad				  	  ."</td>
						   <td>".$estatus				  	  ."</td>";
					print "</tr>";
				}
				print '</table>';
			} else {
				print "0 results";
			}
		}
		if(isset($_POST['submit']))
		{
		   display($servername,$username,$password,$meli,$params,$url);
		} 
	print '</body>';
print '</html>';