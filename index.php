<?php
session_start();
require 'Meli/meli.php';
require 'configApp.php';
$domain = $_SERVER['HTTP_HOST'];
$appName = explode('.', $domain)[0];
?>

<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="Official PHP SDK for Mercado Libre's API.">
        <meta name="keywords" content="API, PHP, Mercado Libre, SDK, meli, integration, e-commerce">
        <title>Mercado Libre PHP SDK</title>
        <link rel="stylesheet" href="/getting-started/style.css" />
        <script src="script.js"></script>
    </head>

    <body>
        <main class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <h3>oAuth</h3>
                    <p>First authenticate yourself. Authentication is the key to get the most ouf Mercado Libre's API.</p>
					<?php
						$meli = new Meli($appId, $secretKey);
						if(isset($_GET['code']) || isset($_SESSION['access_token'])) {
							// If code exist and session is empty
							if(isset($_GET['code']) && !isset($_SESSION['access_token'])) {
								// //If the code was in get parameter we authorize
								try{
									$user = $meli->authorize($_GET["code"], $redirectURI);
									
									// Now we create the sessions with the authenticated user
									$_SESSION['access_token'] = $user['body']->access_token;
									$_SESSION['expires_in'] = time() + $user['body']->expires_in;
									$_SESSION['refresh_token'] = $user['body']->refresh_token;
								}catch(Exception $e){
									echo "Exception: ",  $e->getMessage(), "\n";
								}
							} else {
								// We can check if the access token in invalid checking the time
								if($_SESSION['expires_in'] < time()) {
									try {
										// Make the refresh proccess
										$refresh = $meli->refreshAccessToken();
										// Now we create the sessions with the new parameters
										$_SESSION['access_token'] = $refresh['body']->access_token;
										$_SESSION['expires_in'] = time() + $refresh['body']->expires_in;
										$_SESSION['refresh_token'] = $refresh['body']->refresh_token;
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
					?>
                </div>
			</div>
        </main>
    </body>

</html>