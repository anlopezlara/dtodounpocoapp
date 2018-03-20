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

print '<div class="row">';
	print '<div class="col-sm-1 col-md-1">';
		print '<h3>Inserta Pedidos Tlapalero</h3>';
        print '<p><a class="btn" href="../examples/inserta_pedido_tlapalero.php">Pedidos Tlapalero</a></p>';
    print '</div>';
print '</div>';
