<?php
require_once("SmartCookClient.php");

$request_data = [
    "attributes" => ["id", "name", "author"],
    "filter" => [
        "author" => ["Test User"],
        "dish_category" => [4, 5],
    ]
];

try {
    (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}