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
    print_r('<p>'.$key  .'</p>');
	print_r('<p>'.$value.'</p>');
}
print_r('<p>********************************************************************</p>');
print_r($result[body]);

echo '</pre>';