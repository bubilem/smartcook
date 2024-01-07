<?php
require_once("fce.php");
$url = 'http://www/smartcook/app/api/echo';

$data = [
    "mess" => "Hello there",
    "user" => 1,
    "time" => time()
];
$data['sign'] = create_signature($data, "cd34");

$public_secret = 'ab12';
try {
    $data = request($url, $data);
    echo "Response:\n" . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    $signature = $data["sign"] ?? '';
    unset($data["sign"]);
    echo "Verified: " . (validate_data($data, $signature, $public_secret) ? "yes" : "no");
} catch (Exception $e) {
    echo $e->getMessage();
}
