<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->setRequestData(["mess" => "Hello there"])
        ->sendRequest("echo")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}
