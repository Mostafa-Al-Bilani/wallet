<?php
class User
{

    public $id;
    public $name;
    public $email;
    public $phoneNumber;
    public $dob;
    public $password;
    public $documentID;
    public $createdat;
    public $updatedat;

    function __construct($name="", $email="", $phoneNumber="", $dob="", $password="", $documentID="")
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->dob = $dob;
        $this->password = $password;
        $this->documentID = $documentID;
    }

    function insert($mysqli)
    {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = $mysqli->prepare("INSERT INTO users(`name`, `email`, `phoneNumber`, `dob`, `password`, `documentID`) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssss",  $this->name, $this->email, $this->phoneNumber, $this->dob, $hash, $this->documentID);
        if ($query->execute()) {
            return json_encode([
                "status" => "success",
                "message" => "User registered successfully",
                "user_id" => $query->insert_id 
            ]);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Failed to register user",
                "error" => $query->error 
            ]);
        }
    }
    function select($mysqli)
    {
        $query = $mysqli->prepare("SELECT * FROM USERS");
        $query->execute();
        $array = $query->get_result();
        $response = [];
        while ($user = $array->fetch_assoc()) {
            $response[] = $user;
        }

        echo json_encode($response);
    }

    function update($mysqli, $id)
    {
        $query = $mysqli->prepare("UPDATE users SET `name` = ?, `email` = ?, `phoneNumber` = ?, `dob`= ? WHERE id = ?");
        $query->bind_param("ssssi",  $this->name, $this->email, $this->phoneNumber, $this->dob, $id);
        if ($query->execute()) {
            return json_encode([
                "status" => "success",
                "message" => "User updated successfully",
                "user_id" => $id 
            ]);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Failed to update user",
                "error" => $query->error 
            ]);
        }
    }
    function delete($mysqli, $id)
    {
        $query = $mysqli->prepare("DELETE FROM users WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        return;
    }
    function login($mysqli, $email, $password)
    {
        require_once __DIR__ . '/../auth/generate-jwt.php';

        $query = $mysqli->prepare("SELECT * FROM USERS WHERE `email` = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $res = $query->get_result();
        $user = $res->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            $token = generateAuthToken($user['id']);
            return json_encode([
                "status" => "success",
                "message" => "Login successful",
                "token" => $token,
                "user" => $user
            ]);
        }
        return json_encode(["status" => "error", "message" => "Invalid credentials"]);
    }
}
