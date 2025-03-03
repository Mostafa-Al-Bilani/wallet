<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    include("../../models/transaction.php");
    include("../../connection/connect.php");
    

    $transaction = new Transaction();

    $response = $transaction->select($mysqli);
   echo $response;

?>
