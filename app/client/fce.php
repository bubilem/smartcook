<?php

function request(string $url, array $data = []): array
{
    $cUrl = curl_init($url);
    curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($cUrl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($cUrl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $cUrl,
        CURLOPT_HTTPHEADER,
        [
            'Content-Type: application/json',
            'Accept: application/json;charset=UTF-8'
        ]
    );
    $result = curl_exec($cUrl);
    if (curl_errno($cUrl)) {
        throw new Exception("cUrl exec failed: " . htmlspecialchars(curl_error($cUrl)));
    }
    if (curl_getinfo($cUrl, CURLINFO_HTTP_CODE) != 200) {
        throw new Exception("Bad http response: " . htmlspecialchars(curl_getinfo($cUrl, CURLINFO_HTTP_CODE)));
    }
    curl_close($cUrl);
    return json_decode($result, true);
}

function create_signature(array $data, string $secret): string
{
    return hash_hmac("SHA256", json_encode($data, JSON_INVALID_UTF8_IGNORE), $secret);
}

function validate_data(array $data, string $signature, string $secret): bool
{
    return hash_hmac("SHA256", json_encode($data, JSON_INVALID_UTF8_IGNORE), $secret) === $signature;
}