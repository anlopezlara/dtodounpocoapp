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
        <header class="navbar">
            <a class="logo" href="#"><img src="/getting-started/logo-developers.png" alt=""></a>
            <nav>
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="http://developers.mercadolibre.com/getting-started/">Getting Started</a></li>
                    <li><a target="_blank" href="http://developers.mercadolibre.com/api-docs/">API Docs</a></li>
                    <li><a target="_blank" href="http://developers.mercadolibre.com/community/">Community</a></li>
                </ul>
            </nav>
        </header>

        <div class="header">
            <div>
                <h1>Getting Started with Mercado Libre's PHP SDK</h1>
                <h2>Official PHP SDK for Mercado Libre's API.</h2>
            </div>
        </div>

        <main class="container">
            <h3>Hi, Developer!</h3>
            <p>This is a sample app, deployed to Heroku with Mercado Libre's PHP SDK. Feel free to use it as a base, to start building your awesome app!</p>

            <hr>
            <div class="row">
                <div class="col-md-6">

                    <pre class="pre-item">
						55555555555555555555555
						55555555555555555555555
						55555555555555555555555
                    </pre>

                </div>

            </div>

        </main>
    </body>

    </html>