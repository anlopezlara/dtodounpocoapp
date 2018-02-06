<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
// define variables and set to empty values
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
#$params = array('Producto'=>'MLM602329981');
$params = array();
#$url = '/sites/' . $siteId. '/items/MLM602329981';
$url = '/items/MLM602329981';
$servername = "www.d-todounpoco.com.mx";
$username = "anlopez";
$password = "Azteca02";

$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
  echo 'Prueba';
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
  Website: <input type="text" name="website">
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Prueba 1";

	$sql = "SELECT ref, label, price, accountancy_code_sell, stock
			  FROM i3120427_doli1.doli_product
			 WHERE ref in ('T0057','T0338')";
	$result = $conn->query($sql);
	echo "Prueba 2";
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<p>ref: " . $row["ref"]. " - label: " . $row["label"]. " " . " - price: " . $row["price"]. " - accountancy_code_sell: " . $row["accountancy_code_sell"]. " - stock: " . $row["stock"]. "</p>";
		}
	} else {
		echo "0 results";
	}
	echo "Prueba 3";
	$conn->close();


?>

</body>
</html>