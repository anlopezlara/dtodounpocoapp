<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array('nickname'=>$nickname);
$url = '/sites/' . $siteId. '/search';

$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>2</p>');
#print_r($result);

print_r($result['title']);

#foreach ($result as $i => $value) {
#    unset($array[$i]);
#}

echo '</pre>';