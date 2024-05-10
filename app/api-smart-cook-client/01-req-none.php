<?php
require_once("SmartCookClient.php");
try {
    (new SmartCookClient)
        ->sendRequest("")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}