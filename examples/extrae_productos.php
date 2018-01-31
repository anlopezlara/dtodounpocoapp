<?php
require '../Meli/meli.php';
require '../configApp.php';
$meli = new Meli($appId, $secretKey);
$params = array('nickname'=>$nickname);
$url = '/sites/' . $siteId. '/search';

$result = $meli->get($url, $params);
echo '<pre>';
print_r('<p>4</p>');

#print_r($result["body"]);
foreach($result["body"] as $nivel => $value) { 
	print_r($value);
	print_r('<p>####################VAVLUE######################################</p>');
    print_r($nivel);
	print_r('<p>####################NIVEL######################################</p>');
} 
print_r('<p>************************************************************</p>');
#foreach ($result as $i => $value) {
#    unset($array[$i]);
#}

print_r($result);

echo '</pre>';