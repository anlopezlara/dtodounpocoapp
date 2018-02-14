<?php
session_start();
require 'Meli/meli.php';
require 'configApp.php';
print_r('<p>_appId-->'.$appId.'</p>');
print_r('<p>_secretKey-->'.$secretKey.'</p>');
$meli = new Meli($appId, $secretKey);
if(isset($_GET['code']) || isset($_SESSION['access_token'])) {
	// If code exist and session is empty
	
	print_r('<p>code-->'.$_GET['code'].'</p>');
	print_r('<p>access_token-->'.$_SESSION['access_token'].'</p>');
	
	if(isset($_GET['code']) && !isset($_SESSION['access_token'])) {
		// //If the code was in get parameter we authorize
		print_r('<p>PASA 1</p>');
		try{
			print_r('<p>PASA 2</p>');
			print_r('<p>redirectURI------------->'.$redirectURI.'</p>');
			$user = $meli->authorize($_GET["code"], $redirectURI);
			print_r('<p>PASA 3</p>');
			// Now we create the sessions with the authenticated user
			$_SESSION['access_token'] = $user['body']->access_token;
			$_SESSION['expires_in'] = time() + $user['body']->expires_in;
			$_SESSION['refresh_token'] = $user['body']->refresh_token;
			print_r('<p>PASA 4</p>');
		}catch(Exception $e){
			echo "Exception: ",  $e->getMessage(), "\n";
		}
	} else {
		// We can check if the access token in invalid checking the time
		if($_SESSION['expires_in'] < time()) {
			print_r('<p>PASA 5</p>');
			try {
				print_r('<p>PASA 6</p>');
				// Make the refresh proccess
				$refresh = $meli->refreshAccessToken();
				// Now we create the sessions with the new parameters
				$_SESSION['access_token'] = $refresh['body']->access_token;
				$_SESSION['expires_in'] = time() + $refresh['body']->expires_in;
				$_SESSION['refresh_token'] = $refresh['body']->refresh_token;
				print_r('<p>PASA 7</p>');
			} catch (Exception $e) {
			  	echo "Exception: ",  $e->getMessage(), "\n";
			}
		}
	}
	echo '<pre>';
		print_r($_SESSION);
	echo '</pre>';
} else {
	echo '<a href="' . $meli->getAuthUrl($redirectURI, Meli::$AUTH_URL[$siteId]) . '">Login using MercadoLibre oAuth 2.0</a>';
}