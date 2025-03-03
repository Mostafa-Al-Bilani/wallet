<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Read raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["name"]) && isset($data["email"]) && isset($data["phoneNumber"]) && isset($data["dob"]) && isset($data["password"])) {
    include("../../models/user.php");
    include("../../connection/connect.php");

    $name = $data["name"];
    $email = $data["email"];
    $phoneNumber = $data["phoneNumber"];
    $dob = $data["dob"];
    $password = $data["password"];
    $user = new User($name, $email, $phoneNumber, $dob, $password);
    $response = $user->insert($mysqli);

    echo $response;

} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
