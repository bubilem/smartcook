<?php
/* my personal sandbox */

require_once("SmartCookClient.php");

$request_data = [
    "attributes" => ["id", "name", "author"],
    "filter" => [
        "dish_category" => [],
        "ingredient" => [33]
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