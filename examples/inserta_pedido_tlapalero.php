<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);
date_default_timezone_set('America/Mexico_City');
$now  = new DateTime;
$duration=60;
$dateinsec=strtotime($now->format('Y-m-d H:i:s'));

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
			
			print '<input type="submit" value="click" name="submit"> <!-- assign a name for the button -->';
		print '</form>';
		function display($servername_,$username_,$password_)
		{
			$conn = new mysqli($servername_, $username_, $password_);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			
			$sql = 'SELECT pedido, date_format(fecha,"%d/%m/%Y") fecha_pedido 
			          FROM db_dtodounpoco.carga_pedido_tlapalero 
					 GROUP BY pedido, fecha 
					 ORDER BY pedido desc';
			$result = $conn->query($sql);
			
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					#echo $row["pedido"].' - '.$row["fecha_pedido"].'<br>';
					echo '<input type="radio" name="gender" value="'.$row["pedido"].'">$row["pedido"].' - '.$row["fecha_pedido"]<br>';
				}
			}
			
			
		}
		if(isset($_POST['submit']))
		{
		   display($servername,$username,$password);
		} 
	print '</body>';
print '</html>';