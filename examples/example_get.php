<?php
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);

$params = array();

$url = '/sites/' . $siteId;

$result = $meli->get($url, $params);

echo '<pre>';
print_r($params);
print_r($siteId);
print_r($url);
print_r($result);
echo '</pre>';