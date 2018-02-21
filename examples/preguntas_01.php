<?php
session_start();
require '../Meli/meli.php';
require '../configApp.php';

$conn = new mysqli($servername_, $username_, $password_);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM sesion_meli";

$result = $conn->query($sql);

print_r($result);