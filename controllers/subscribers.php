<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require 'crudsubscribers.php';
use GuzzleHttp\Client;

const BASE_URL   = 'https://api.aweber.com/1.0/';

// Create a Guzzle client
$client          = new GuzzleHttp\Client();

// Load credentials
$credentials     = parse_ini_file('../config/credentials.ini', true);
$accessToken     = $credentials['accessToken'];

$nameSubscriber  = $_POST['name'];
$emailSubscriber = $_POST['email'];
$trackSubscriber = $_POST['track'];
$checkSubscriber = $_POST['check'];
$ipAddress       = "";
$dateHour        = "";
$url             = "";

if($checkSubscriber != 0){
  //Get IP Address
  if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
  }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ipAddress = $_SERVER['REMOTE_ADDR'];
  }

  //Get date_Hour
  $dateHour = date("Y-m-d h:i:s");

  //Get URL
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
    $url = "https"; 
  }else{
    $url = "http";
  } 
  
  $url .= "://"; 
  $url .= $_SERVER['HTTP_HOST']; 
  $url .= $_SERVER['REQUEST_URI'];
}

/**
 * Get all of the entries for a collection
 *
 * @param Client $client HTTP Client used to make a GET request
 * @param string $accessToken Access token to pass in as an authorization header
 * @param string $url Full url to make the request
 * @return array Every entry in the collection
 */
function getCollection($client, $accessToken, $url) {
  $collection = array();
  while (isset($url)) {
      $request = $client->get($url,
        ['headers' => ['Authorization' => 'Bearer ' . $accessToken]]
      );
      $body       = $request->getBody();
      $page       = json_decode($body, true);
      $collection = array_merge($page['entries'], $collection);
      $url        = isset($page['next_collection_link']) ? $page['next_collection_link'] : null;
  }
  return $collection;
}

// get all the accounts entries
$accounts   = getCollection($client, $accessToken, BASE_URL . 'accounts');
$accountUrl = $accounts[0]['self_link'];

// get all the list entries for the first account
$listsUrl   = $accounts[0]['lists_collection_link'];
$lists      = getCollection($client, $accessToken, $listsUrl);

// find out if a subscriber exists on the first list
$email      = $emailSubscriber;
$params     = array(
  'ws.op' => 'find',
  'email' => $email
);

$subsUrl          = $lists[0]['subscribers_collection_link'];
$findUrl          = $subsUrl . '?' . http_build_query($params);
$foundSubscribers = getCollection($client, $accessToken, $findUrl);

if (isset($foundSubscribers[0]['self_link'])) {
  // update the subscriber if they are on the first list
  $data = array(
    'name'          => $nameSubscriber,
    'email'         => $emailSubscriber,
    'ad_tracking'   => $trackSubscriber,
    'custom_fields' => array(
      'IP'   => $ipAddress,
      'Date' => $dateHour,
      'URL'  => $url
    ),
    'tags'          => array(
      'add' => array(
        'test_existing_sub'
      )
    )
  );
  $subscriberUrl      = $foundSubscribers[0]['self_link'];
  $subscriberResponse = $client->patch($subscriberUrl, [
    'json' => $data, 
    'headers' => ['Authorization' => 'Bearer ' . $accessToken]
  ])->getBody();
  $subscriber = json_decode($subscriberResponse, true);
  
  $crudSubscriber = new CrudSubscribers();
  $crudSubscriber->update($data);
} else {
  // add the subscriber if they are not already on the first list
  $data = array(
    'name'          => $nameSubscriber,
    'email'         => $emailSubscriber,
    'ad_tracking'   => $trackSubscriber,
    'custom_fields' => array(
      'IP'   => $ipAddress,
      'Date' => $dateHour,
      'URL'  => $url
    ),
    'tags' => array('test_new_sub')
  );
  $body = $client->post($subsUrl, [
    'json'    => $data, 
    'headers' => ['Authorization' => 'Bearer ' . $accessToken]
  ]);

  // get the subscriber entry using the Location header from the post request
  $subscriberUrl      = $body->getHeader('Location')[0];
  $subscriberResponse = $client->get($subscriberUrl,
    ['headers' => ['Authorization' => 'Bearer ' . $accessToken]])->getBody();
  $subscriber = json_decode($subscriberResponse, true);
  $crudSubscriber = new CrudSubscribers();
  $crudSubscriber->create($data);
}