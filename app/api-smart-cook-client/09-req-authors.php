<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->sendRequest("authors")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}