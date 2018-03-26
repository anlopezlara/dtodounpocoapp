<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);
date_default_timezone_set('America/Mexico_City');
$now  = new DateTime;
$duration=60;
$dateinsec=strtotime($now->format('Y-m-d H:i:s'));
$PedidoTlapalero = "";

$db_username = $username_desa;

$conn = new mysqli($servername, $db_username, $password);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$sqlPedido = 'SELECT pedido, date_format(fecha,"%d/%m/%Y") fecha_pedido 
		      FROM db_dtodounpoco.carga_pedido_tlapalero 
		      GROUP BY pedido, fecha 
		      ORDER BY pedido desc';
$result = $conn->query($sqlPedido);

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
			print '<table class="border" width="70">';
				print "<tr><td>Pedido</td>
				           <td>Fecha</td>
						   <td>Selecciona</td>
					   </tr>";
				if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					print "<tr>";
						echo '<td>'.$row["pedido"].'</td><td>'.$row["fecha_pedido"].'</td><td><input type="radio" name="PedidoTlapalero" value="'.$row["pedido"].'"></td>';
					print "</tr>";
				}
			}
			print '</table>';
			print "<br>";
			print '<input type="submit" value="click" name="submit_ped"> <!-- assign a name for the button -->';
		print '</form>';
		function input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(isset($_POST['submit_ped']))
		{
		   $PedidoTlapalero = input($_POST["PedidoTlapalero"]);
		   display($servername,$db_username,$password,$PedidoTlapalero);
		} 
		function display($servername_,$username_,$password_,$PedidoTlapalero_)
		{
			$conn = new mysqli($servername_, $username_, $password_);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			echo ($PedidoTlapalero_);
			$sqlDetalle = 'SELECT c.pedido 
					  FROM db_dtodounpoco.carga_pedido_tlapalero         c
					 WHERE c.pedido = '.$PedidoTlapalero_;
			
			print '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  ';
				print '<table class="border" width="70">';
					print "<tr><td>pedido</td>
						   </tr>";
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						print "<tr>";
							echo '<td>'.$row["pedido"]     .'</td>
								  <td><input type="checkbox" name="PedidoDetalle[]" value="'.$row["pedido"].'" checked></td>';
						print "</tr>";
					}
				}
				print '</table>';
				print "<br>";
				print '<input type="submit" value="click" name="submit_det"> <!-- assign a name for the button -->';
			print '</form>';
		}
		if(isset($_POST['submit_det']))
		{
		   $PedidoTlapalero = input($_POST["PedidoDetalle"]);
		   display_det($servername,$db_username,$password,$PedidoTlapalero);
		} 
		function display_det($servername_,$username_,$password_,$PedidoTlapalero_)
		{
			$aDetalle = $_POST['PedidoDetalle'];
			if(empty($aDetalle))
			{
			  echo("No seleccionó ningún Producto");
			}
			else
			{
			  $N = count($aDetalle);
			  for($i=0; $i < $N; $i++)
			  {
				echo($aDetalle[$i]."<br> ");
			  }
			}
		}
		print '</body>';
print '</html>';