<?php

/* Go to My Apps dashboard: https://developers.mercadolibre.com.ar/apps/home, and get the information you need in order to the following enviroment variables */

/* Your Application Id */
$appId = getenv('App_ID');

/* Your Secret Key */
$secretKey = getenv('Secret_Key');

/* The Redirect url */
$redirectURI = getenv('Redirect_URI');

/* The site id of the country where your application will work.
If you don't know your site_id go to our sites resources: https://api.mercadolibre.com/sites  */
$siteId = 'MLM';

$nickname = getenv('nickname');

/* My SQL database */
$servername = getenv('servername');
$username = getenv('username');
$username_desa = getenv('username_desa');
$password = getenv('password');
$db_dtodounpoco = getenv('db_dtodounpoco');

//////////////////////////////////////////////////////////////////////////////////////////////////////
//If you don't use Heroku use the next config

// $appId = 'App_ID';

// $secretKey = 'Secret_Key';

// $redirectURI = 'Redirect_URI';

// $siteId = 'MLB';
