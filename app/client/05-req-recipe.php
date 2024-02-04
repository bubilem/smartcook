<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->setRequestData(["recipe_id" => 1])
        ->sendRequest("recipe")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}