<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Read raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["name"]) && isset($data["email"]) && isset($data["phoneNumber"]) && isset($data["dob"])) {
    include("../../models/user.php");
    include("../../connection/connect.php");
    include("../../auth/check-auth-token.php");

    $authArray = checkAuthToken();
    $userid = $authArray['user_id'];


    $name = $data["name"];
    $email = $data["email"];
    $phoneNumber = $data["phoneNumber"];
    $dob = $data["dob"];
    $user = new User($name, $email, $phoneNumber, $dob);
    $response = $user->update($mysqli, $userid);

    echo $response;

} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
