<?php
require_once("SmartCookClient.php");
/*
$filter = [
    "author" => ["Test User"],
    "dish_category" => [4, 5],
];
*/
$filter = [
    "ingredient" => [59, 208],
];
$request_data = [
    "attributes" => ["id", "name", "author"],
    "filter" => $filter
];

try {
    (new SmartCookClient)
        ->setRequestData($request_data)
        ->sendRequest("recipes")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}