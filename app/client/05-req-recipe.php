<?php
require_once("fce.php");
$url = 'http://www/smartcook/app/api/recipe/1';

$public_secret = 'ab12';

try {
    $data = request($url);
    echo "Response:\n" . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    $signature = $data["sign"] ?? '';
    unset($data["sign"]);
    echo "Verified: " . (verify_data($data, $signature, $public_secret) ? "yes" : "no");
} catch (Exception $e) {
    echo $e->getMessage();
}
