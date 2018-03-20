<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);
date_default_timezone_set('America/Mexico_City');
$now  = new DateTime;
$duration=60;
$dateinsec=strtotime($now->format('Y-m-d H:i:s'));

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM db_dtodounpoco.sesion_meli";
$result = $conn->query($sql);

print '<html>';
	print '<body>';
		print('<p>Prueba----->1</p>');
		if ($result->num_rows > 0) {
			//echo '<p>'.$result.'</p>';
			while($row = $result->fetch_assoc()) {
				if ($row['id_valor'] == 'access_token')
					$access_token = $row['valor'];
				if ($row['id_valor'] == 'expires_in')
					$expires_in = $row['valor'];
				if ($row['id_valor'] == 'refresh_token')
					$refresh_token = $row['valor'];
			}
			echo '<p>'.$access_token .'</p>';
			echo '<p>'.$expires_in   .'</p>';
			echo '<p>'.$refresh_token.'</p>';

		} 
		else {
			print_r("No hubo conexión a la base de datos");
					
		}
		$newdate=$dateinsec+$expires_in;
		echo $now->format('Y-m-d H:i:s'),  "\n";
		echo date('Y-m-d H:i:s',$newdate), "\n";
	print '</body>';
print '</html>';