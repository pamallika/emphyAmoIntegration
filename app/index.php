<?php

require 'vendor/autoload.php';

use AmoCRM\Client\AmoCRMApiClient;
use Symfony\Component\Dotenv\Dotenv;

session_start();
$env = parse_ini_file('.env');
$clientId = $env["CLIENT_ID"];
$clientSecret = $env["CLIENT_SECRET"];
$redirectUri = $env["CLIENT_REDIRECT_URI"];
//var_dump($clientId);
$apiClient = new AmoCRMApiClient($clientId, $clientSecret, $redirectUri);
$state = bin2hex(random_bytes(16));
$_SESSION['oauth2state'] = $state;
echo $apiClient->getOAuthClient()->getOAuthButton(
    [
        'title' => 'Установить интеграцию',
        'compact' => true,
        'class_name' => 'className',
        'color' => 'default',
        'error_callback' => 'handleOauthError',
        'state' => $state,
    ]
);
die;
/** Отловить ответ*/
//$accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);

//if (!$accessToken->hasExpired()) {
//    saveToken([
//        'accessToken' => $accessToken->getToken(),
//        'refreshToken' => $accessToken->getRefreshToken(),
//        'expires' => $accessToken->getExpires(),
//        'baseDomain' => $apiClient->getAccountBaseDomain(),
//    ]);
//}
//var_dump($_GET['code']);
//var_dump($accessToken);
die();