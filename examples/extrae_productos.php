<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
#$params = array('Producto'=>'MLM602329981');
$params = array($Producto=>'602329981');
#$url = '/sites/' . $siteId. '/items/MLM602329981';
$url = '/items/MLM';

$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>1</p>');

print_r($result);

echo '</pre>';