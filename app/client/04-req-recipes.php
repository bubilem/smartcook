<?php
require_once("SmartCookClient.php");

$request_data = [];

try {
    (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}