<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->setRequestData(["recipe_id" => 2])
        ->sendRequest("recipe-remove")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}