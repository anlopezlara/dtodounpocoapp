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

if ($result->num_rows > 0) {
	print_r($result);	
	while($row = $result->fetch_assoc()) {
		print_r($row[0]);
		print_r($row[1]);		
	}
} 
else {
	print_r("No hubo conexión a la base de datos");
			
}
