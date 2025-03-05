<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    include("../../models/transaction.php");
    include("../../connection/connect.php");
    include("../../auth/check-auth-token.php");
    

    $transaction = new Transaction();
<<<<<<< HEAD
    $authArray = checkAuthToken();
    $userid = $authArray['user_id'];

    $response = $transaction->select($mysqli, $userid);
    echo $response;
=======
    $authArray = checkAuthToken();  
    $userid = $authArray['user_id'];

>>>>>>> 0f29cd464a5578ecb791f004e43411ea35cb9f96

    $response = $transaction->select($mysqli, $userid);
    echo $response;

?>