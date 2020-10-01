<?php
require 'vendor/autoload.php';
use League\Oauth2\Client\Provider\GenericProvider;


const OAUTH_URL = 'https://auth.aweber.com/oauth2/';
const TOKEN_URL = 'https://auth.aweber.com/oauth2/token';


$createRefresh = rtrim(fgets(STDIN), PHP_EOL);

$credentials = parse_ini_file('config/credentials.ini', true);
if(sizeof($credentials) == 0 ||
    !array_key_exists('clientId', $credentials) ||
    !array_key_exists('clientSecret', $credentials) ||
    !array_key_exists('accessToken', $credentials) ||
    !array_key_exists('refreshToken', $credentials)) {
    echo "No credentials.ini exists, or file is improperly formatted.\n";
    echo "Please create new credentials.";
    exit();
}

$client = new GuzzleHttp\Client();
$clientId = $credentials['clientId'];
$clientSecret = $credentials['clientSecret'];
$response = $client->post(
    TOKEN_URL, [
        'auth' => [
            $clientId, $clientSecret
        ],
        'json' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => $credentials['refreshToken']
        ]
    ]
);
$body = $response->getBody();
$newCreds = json_decode($body, true);
$accessToken = $newCreds['access_token'];
$refreshToken = $newCreds['refresh_token'];


$fp = fopen('config/credentials.ini', 'wt');
fwrite($fp,
"clientId = {$clientId}
clientSecret = {$clientSecret}
accessToken = {$accessToken}
refreshToken = {$refreshToken}");
fclose($fp);
chmod('config/credentials.ini', 0755);