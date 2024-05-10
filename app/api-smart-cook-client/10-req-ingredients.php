<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->sendRequest("ingredients")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}