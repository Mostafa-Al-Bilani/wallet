<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Read raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["amount"])) {
    include("../../models/transaction.php");
    include("../../connection/connect.php");
    include("../../auth/check-auth-token.php");

    $amount = $data["amount"];
    $authArray = checkAuthToken();
    $userid = $authArray['user_id'];
    
    $transaction = new transaction($userid, $amount, "deposit");
    $response = $transaction->insert($mysqli);

    echo $response;

} else {
    echo json_encode(["message" => "Invalid request"]);
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 0f29cd464a5578ecb791f004e43411ea35cb9f96
