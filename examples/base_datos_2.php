<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <input type="text" name="studentname">
    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->
</form>

<?php
$servername = "www.d-todounpoco.com.mx";
$username = "anlopez";
$password = "Azteca02";
function display()
{
    echo "hello ".$_POST["studentname"];
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Prueba";

	$sql = "SELECT ref, label, price, accountancy_code_sell, stock
			  FROM i3120427_doli1.doli_product
			 WHERE ref in ('T0057','T0338')";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<p>ref: " . $row["ref"]. " - label: " . $row["label"]. " " . " - price: " . $row["price"]. " - accountancy_code_sell: " . $row["accountancy_code_sell"]. " - stock: " . $row["stock"]. "</p>";
		}
	} else {
		echo "0 results";
	}

	$conn->close();
	
}
if(isset($_POST['submit']))
{
   display();
} 
?>