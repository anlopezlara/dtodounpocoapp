<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
#$params = array('Producto'=>'MLM602329981');
$params = array();
#$url = '/sites/' . $siteId. '/items/MLM602329981';
$url = '/items/MLM602329981';

$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>2</p>');

#print_r($result[body]);
foreach ( $result[body] as $key => &$value )
{
	if ($key == 'id') {
		print_r('<p>'.$key.' -->'.$value.'</p>');
	}
	if ($key == 'title') {
		print_r('<p>'.$key.' -->'.$value.'</p>');
	}
	if ($key == 'price') {
		print_r('<p>'.$key.' -->'.$value.'</p>');
	}
	if ($key == 'available_quantity') {
		print_r('<p>'.$key.' -->'.$value.'</p>');
	}
	if ($key == 'status') {
		print_r('<p>'.$key.' -->'.$value.'</p>');
	}
}
print_r('<p>********************************************************************</p>');
print_r($result[body]);

echo '</pre>';