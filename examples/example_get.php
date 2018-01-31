<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array();
$url = '/sites/' . $siteId;

$result = $meli->get('$url', array('nickname' => 'RODIA2000'));
echo '<pre>';
print_r('<p>1$appId    -->'.$appId    .'</p>');
print_r('<p>1$secretKey-->'.$secretKey.'</p>');
print_r('<p>1$params   -->'.$params   .'</p>');
print_r('<p>1$url      -->'.$url      .'</p>');
print_r('<p>1$siteId   -->'.$siteId   .'</p>');
print_r($result);
echo '</pre>';