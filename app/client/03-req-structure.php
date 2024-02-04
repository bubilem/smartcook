<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->sendRequest("structure")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}