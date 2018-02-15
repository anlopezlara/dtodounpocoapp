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
        <meta name="description" content="De todo un poco portal">
        <meta name="keywords" content="De todo un poco portal">
        <title>De todo un poco portal</title>
        <link rel="stylesheet" href="/getting-started/style.css" />
        <script src="script.js"></script>
    </head>

    <body>
        <div class="header">
            <div>
                <h1>De todo un poco y Mercado libre</h1>
            </div>
        </div>

        <main class="container">
            <hr>
            <div class="row">
                <div class="col-sm-1 col-md-1">
                    <h3>Autentificar Mercado Libre</h3>
                    <p>Presiones el botón para abrir sesión a mercado libre, si la sesión ya esta abierta deplegará el token</p>

                    <?php
                    $meli = new Meli($appId, $secretKey);
                    if($_GET['code'] || $_SESSION['access_token']) {
                        // If code exist and session is empty
                        if($_GET['code'] && !($_SESSION['access_token'])) {
                            // If the code was in get parameter we authorize
                            $user = $meli->authorize($_GET['code'], $redirectURI);
                            // Now we create the sessions with the authenticated user
                            $_SESSION['access_token'] = $user['body']->access_token;
                            $_SESSION['expires_in'] = time() + $user['body']->expires_in;
                            $_SESSION['refresh_token'] = $user['body']->refresh_token;
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
                        echo '<p><a alt="Login using MercadoLibre oAuth 2.0" class="btn" href="' . $meli->getAuthUrl($redirectURI, Meli::$AUTH_URL[$siteId]) . '">Authenticate</a></p>';
                    }
                    ?>

                </div>
            </div>
        </main>
    </body>

</html>