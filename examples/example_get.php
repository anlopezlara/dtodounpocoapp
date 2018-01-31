<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array("nickname" => "RODIA2000");
$url = '/sites/' . $siteId;

$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>2$appId    -->'.$appId    .'</p>');
print_r('<p>$secretKey-->'.$secretKey.'</p>');
print_r('<p>$params   -->'.$params   .'</p>');
print_r('<p>$url      -->'.$url      .'</p>');
print_r('<p>$siteId   -->'.$siteId   .'</p>');
print_r($result);
echo '</pre>';