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
		
		print '#p_rojo     {background-color:rgba(255,0,0,0.3);}';
		print '#p_verde    {background-color:rgba(0,255,0,0.3);}';
		print '#p_azul     {background-color:rgba(0,0,255,0.3);}';
		print '#p_gris     {background-color:rgba(192,192,192,0.3);}';
		print '#p_amarillo {background-color:rgba(255,255,0,0.3);}';
		print '#p_fucsia   {background-color:rgba(255,0,255,0.3);}';
		
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
		   $_SESSION["SPedidoTlapalero"] = input($_POST["PedidoTlapalero"]);
		   display($servername,$db_username,$password,$_SESSION["SPedidoTlapalero"]);
		} 
		function display($servername_,$username_,$password_,$PedidoTlapalero_)
		{
			$conn = new mysqli($servername_, $username_, $password_);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$sqlDetalle = 'SELECT c.pedido        Pedido          ,
						   c.codigo               Codigo          ,
						   FORMAT(c.precio    ,2) Precio_tlapalero,
						   FORMAT(a.price     ,2) Pecio_Proveedor ,
						   FORMAT(b.cost_price,2) Pecio_producto  ,
						   cantidad               Cantidad        ,
						   fecha                  Fecha           ,
						   descripcion            Descripcion
					  FROM i3120427_doli3.doli_product_fournisseur_price a,
						   i3120427_doli3.doli_product                   b,
						   db_dtodounpoco.carga_pedido_tlapalero         c
					 WHERE a.fk_product = b.rowid
					   AND a.ref_fourn = c.codigo
					   AND c.pedido = '.$PedidoTlapalero_;
						   
			$result = $conn->query($sqlDetalle);
			
			print '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  ';
				print '<table class="border" width="70">';
					print "<tr><td>Pedido</td>
							   <td>Codigo</td>
							   <td>Precio tlapalero</td>
							   <td>Pecio Proveedor</td>
							   <td>Pecio producto</td>
							   <td>Cantidad</td>
							   <td>Fecha</td>
							   <td>Descripción</td>
							   <td>Tipo Pago</td>
							   <td>Selecciona</td>
						   </tr>";
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if ($row["Precio_tlapalero"] == $row["Pecio_Proveedor"])
						{
							if ($row["Precio_tlapalero"] == $row["Pecio_producto"])
								$Marca = '';
							else
								$Marca = 'style="background-color:Tomato;"';
						}	
						else
							$Marca = 'style="background-color:Tomato;"';
						print "<tr>";
							echo '<td>'           .$row["Pedido"          ].'</td>
							      <td>'           .$row["Codigo"          ].'</td>
								  <td '.$Marca.'>'.$row["Precio_tlapalero"].'</td>
								  <td '.$Marca.'>'.$row["Pecio_Proveedor" ].'</td>
								  <td '.$Marca.'>'.$row["Pecio_producto"  ].'</td>
							      <td>'           .$row["Cantidad"        ].'</td>
								  <td>'           .$row["Fecha"           ].'</td>
							      <td>'           .$row["Descripcion"     ].'</td>
								  <td><input type="radio" name="Pago'.$row["Codigo"].'" value="Bancomer" checked>Bancomer
								      <input type="radio" name="Pago'.$row["Codigo"].'" value="ActivoCirculante" >Activo Circulante
								  <td><input type="checkbox" name="PedidoDetalle[]" value="'.$row["Codigo"].'" checked></td>';
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
		    display_det($servername,$db_username,$password,$db_dtodounpoco);
		} 
		function display_det($servername_,$db_username_,$password_,$db_dtodounpoco_)
		{
			$conn = new mysqli($servername_, $db_username_, $password_);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$Detalle = $_POST['PedidoDetalle'];
			if(empty($Detalle))
			{
			  echo("No seleccionó ningún Producto");
			}
			else
			{
				print '<p>ACCIONES</p><br>';
				$N = count($Detalle);
				for($i=0; $i < $N; $i++)
				{
					$mysqli = new mysqli($servername_,$db_username_,$password_, $db_dtodounpoco_);
					if ($mysqli->connect_errno) {
						echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
					}
					if (!$mysqli->query("SET @msg = ''") || !$mysqli->query("CALL p_actualiza_producto_desa(".$_SESSION["SPedidoTlapalero"].",'".$Detalle[$i]."','".$_POST["Pago".$Detalle[$i]]."',@msg)")) {
						echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
					}
					if (!($res = $mysqli->query("SELECT @msg as _p_out"))) {
						echo "Fetch failed: (" . $mysqli->errno . ") " . $mysqli->error;
					}
					$row = $res->fetch_assoc();
					echo('<p id="p_gris">'.$row['_p_out'].'</p><br>');				
				}
			}
		}
		print '</body>';
print '</html>';