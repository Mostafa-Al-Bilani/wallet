<?php
class Transaction
{

    public $id;
    public $userId;
    public $amount;
    public $description;
    public $createdat;
    public $updatedat;
    private $table = "transactions";

    function __construct($userId="", $amount="", $description="")
    {
        $this->userId = $userId;
        $this->amount = $amount;
        $this->description = $description;
    }

    function insert($mysqli)
    {
        $query = $mysqli->prepare("INSERT INTO $this->table(`userId`, `amount`, `description`) VALUES (?, ?, ?)");
        $query->bind_param("ids",  $this->userId, $this->amount, $this->description);
        if ($query->execute()) {
            return json_encode([
                "status" => "success",
                "message" => "transaction created successfully",
                "transaction_id" => $query->insert_id 
            ]);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Failed to create transaction",
                "error" => $query->error 
            ]);
        }
    }
    function select($mysqli)
    {
        $query = $mysqli->prepare("SELECT * FROM $this->table");
        $query->execute();
        $array = $query->get_result();
        $response = [];
        while ($transaction = $array->fetch_assoc()) {
            $response[] = $transaction;
        }
        return json_encode([
            "status" => "success",
            "transactions" => $response 
        ]);
    }

    function update($mysqli, $id)
    {
        $query = $mysqli->prepare("UPDATE $this->table SET `amount` = ?, `description` = ? WHERE id = ?");
        $query->bind_param("dsi", $this->amount, $this->description, $id);
        $query->execute();
        return;
    }
    function delete($mysqli, $id)
    {
        $query = $mysqli->prepare("DELETE FROM $this->table WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        return;
    }
    
}
