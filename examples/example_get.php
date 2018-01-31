<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array();
$url = '/sites/' . $siteId;
$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>'.$appId    .'</p>');
print_r('<p>'.$secretKey.'</p>');
print_r('<p>'.$params   .'</p>');
print_r('<p>'.$url      .'</p>');
print_r('<p>'.$result   .'</p>');
echo '</pre>';