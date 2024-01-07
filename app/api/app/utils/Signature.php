<?php

class Signature
{
    public static function create(array $data, string $secret): string
    {
        return hash_hmac("SHA256", json_encode($data, JSON_INVALID_UTF8_IGNORE), $secret);
    }

    public static function validate(array $data, string $signature, string $secret): bool
    {
        return hash_hmac("SHA256", json_encode($data, JSON_INVALID_UTF8_IGNORE), $secret) === $signature;
    }

}
