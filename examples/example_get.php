<?php
require '../Meli/meli.php';
require '../configApp.php';

$meli = new Meli($appId, $secretKey);

$params = array();

$url = '/sites/' . $siteId;

$result = $meli->get($url, $params);

echo '<pre>';
println('params' . $params);
println('siteId' . $siteId);
println('url' . $url);
printr($result);
echo '</pre>';