<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;

// this function used when user login
function generateAuthToken($user_id) {
    $config = require_once 'config.php';
    $secret_key = $config['jwt_secret'];

    $payload = [
        'user_id' => $user_id,
        'exp' => time() + (60 * 60), // Token expires in 1 hour
    ];

    // Generate the token
    return JWT::encode($payload, $secret_key, 'HS256');
}

?>
