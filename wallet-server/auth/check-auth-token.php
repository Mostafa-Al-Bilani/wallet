<?php

require_once __DIR__ . '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// this is used when user uses an api request, so we need to check if the token is sent with the api request and its correct
function checkAuthToken() {
    $config = require_once 'config.php';
    $secret_key = $config['jwt_secret'];

    $headers = apache_request_headers();

    if (!isset($headers['Authorization'])) {
        return ['error' => 'Auth token is missing'];
    }

    $authorization = $headers['Authorization'];
    $headerValue = explode(' ', $authorization);
    
    if (count($headerValue) < 2) {
        return ['error' => 'Invalid authorization header format'];
    }

    $jwt = $headerValue[1];

    try {
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));

        // Convert object to array
        $decoded_array = (array) $decoded;

        return [
            'success' => true,
            'user_id' => $decoded_array['user_id'],
            'data' => $decoded_array
        ];
    } catch (Exception $e) {
        return ['error' => 'Error decoding JWT: ' . $e->getMessage()];
    }
}

?>
