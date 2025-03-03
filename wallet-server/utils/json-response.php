<?php
function jsonResponse($status, $message)
{
    $response = array();
    $response["success"] = $status;
    $response["message"] = $message;
    return json_encode($response);
}
