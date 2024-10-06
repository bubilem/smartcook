<?php
require_once "conf.php";
require_once "SmartCookClient.php";
$scc = new SmartCookClient(API_URL, API_SENDER, API_SMARTCOOK);
try {
    $response = $scc
        ->sendRequest("ingredients")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}
if (!empty($response['data'])) {
    foreach ($response['data'] as $ingredient) {
        echo "<button data-ingredient-id=\"{$ingredient['id']}\" data-ingredient-name=\"{$ingredient['name']}\">{$ingredient['name']} <span class=\"badge\">{$ingredient['number_of_uses']}</span></button>";
    }
} else {
    echo "<p>no ingredients found</p>";
}