<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM db_dtodounpoco.sesion_meli";

$result = $conn->query($sql);
print '<html>';
	print '<body>';
		print('<p>Prueba</p>');
		if ($result->num_rows > 0) {
			print_r($result);
			/*while($row = $result->fetch_assoc()) {
				if ($row['id_valor'] == 'access_token')
					$access_token = $row['valor'];
				if ($row['id_valor'] == 'expires_in')
					$expires_in = $row['valor'];
				if ($row['id_valor'] == 'refresh_token')
					$refresh_token = $row['valor'];
			}
			print_r('<p>'.$access_token.'</p>');
			print_r('<p>'.$expires_in.'</p>');
			print_r('<p>'.$refresh_token.'</p>');*/

		} 
		else {
			print_r("No hubo conexión a la base de datos");
					
		}
	print '</body>';
print '</html>';