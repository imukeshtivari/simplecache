<?php

require dirname(__FILE__) . "/src/SimpleCache.php";

$sCache = new SimpleCache(dirname(__FILE__) . "/cache");

$sCache->data = [
	// pass data here
	// "_ts" => time() // for getting fresh data
];

$username = "usnername";
$password = "password";

$sCache->headers = [
	// pass header here
	// "Authorization: Basic " . base64_encode("{$username}:{$password}") // ypu can pass api_key and any other header from this array
];

$response = $sCache->get("http://www.omdbapi.com/?t=2012");

print_r($response);die;