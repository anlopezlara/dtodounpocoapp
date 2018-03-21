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

$sql = 'SELECT pedido, date_format(fecha,"%d/%m/%Y") fecha_pedido FROM db_dtodounpoco.carga_pedido_tlapalero GROUP BY pedido, fecha ORDER BY pedido desc';
$result = $conn->query($sql);

// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $gender = test_input($_POST["gender"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

Print '<h2>Pedido Tlapalero</h2>';
echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">';
Print '  <input type="radio" name="gender" value="female">Female <br>';
Print '  <input type="radio" name="gender" value="male">Male <br>';
Print '<br><br>';
Print '  <input type="submit" name="submit" value="Submit">';
Print '</form>';

echo "<h2>Your Input:</h2>";
echo "<br>";
echo $gender;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		#print $row["pedido"];
		echo 'Pasa 1';
	}
}else
{
	echo 'Pasa 2';
}
