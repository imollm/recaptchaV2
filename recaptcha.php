<?php

$url = 'https://www.google.com/recaptcha/api/siteverify';
$secret = 'YOUR SECRET HERE';

// GET FORM DATA
$captcha = $_POST['g-recaptcha-response'];
$data = array(
    'secret' => $secret,
    'response' => $captcha,
    'remoteip' => $_SERVER['REMOTE_ADDR'] // THIS IS OPTIONAL
);

// PREPARE THE REQUEST
$curlConfig = array(
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => $data
);

// GOOGLE RECAPTCHA REQUEST
$ch = curl_init();
curl_setopt_array($ch, $curlConfig);
$response = curl_exec($ch);
curl_close($ch);

$jsonResponse = json_decode($response);

// CHECK RESULT
if ($jsonResponse->success === true) {
    echo "SUCCESS";
} else {
    echo "FAILED";
}
