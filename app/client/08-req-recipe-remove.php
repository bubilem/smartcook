<?php
require_once("fce.php");
$url = 'https://www.smartcook-project.eu/api/recipe-remove';

$data = [
    "recipe_id" => 3,
    "user" => 1,
    "time" => time()
];

$data['sign'] = create_signature($data, "xxx");

$public_secret = 'smrtck';
try {
    $data = request($url, $data);
    echo "Response:\n" . json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    $signature = $data["sign"] ?? '';
    unset($data["sign"]);
    echo "Verified: " . (validate_data($data, $signature, $public_secret) ? "yes" : "no");
} catch (Exception $e) {
    echo $e->getMessage();
}
