<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
#$params = array('Producto'=>'MLM602329981');
$params = array();
#$url = '/sites/' . $siteId. '/items/MLM573165050';
$url = '/items/MLM573165050';

$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>4</p>');

print_r($result);

echo '</pre>';