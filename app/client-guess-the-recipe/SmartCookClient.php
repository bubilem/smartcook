<?php

/**
 * SmartCook Client
 * 
 * Prepared for the simple work of communicating 
 * with the SmartCook API in a PHP application
 * 
 */
class SmartCookClient
{
    /**
     * URL to API
     * https://www.smartcook-project.eu/api/
     */
    private string $URL;

    /**
     * The user who sends requests to the API
     */
    private array $SENDER;

    /**
     * The user who sends responses from the API
     */
    private array $SMARTCOOK;

    private array $request_data = [];
    private array $response_data = [];

    public function __construct(string $url, array $sender, array $smartcook)
    {
        $this->URL = $url;
        $this->SENDER = $sender;
        $this->SMARTCOOK = $smartcook;
    }

    public function setSender(array $sender): static
    {
        $this->SENDER = $sender;
        return $this;
    }

    public function clear(): static
    {
        $this->request_data = [];
        $this->response_data = [];
        return $this;
    }

    public function setRequestData(array $request_data): static
    {
        $this->request_data = $request_data;
        return $this;
    }

    public function getResponseData(): array
    {
        return $this->response_data;
    }

    public function prepareRequestDataToSend(): string
    {
        if (!empty($this->request_data)) {
            $data = $this->request_data;
            $data["user"] = $this->SENDER["id"];
            $data["time"] = time();
            $data['sign'] = self::createSignature($data, $this->SENDER["secret"]);
            return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        return '';
    }

    public function sendRequest(string $endpoint): static
    {
        $cUrl = curl_init($this->URL . $endpoint);
        curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cUrl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($cUrl, CURLOPT_POSTFIELDS, $this->prepareRequestDataToSend());
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
        $this->response_data = json_decode($result, true);
        return $this;
    }

    public function validateResponseData(): bool
    {
        $signature = $this->response_data["sign"] ?? '';
        unset($this->response_data["sign"]);
        return self::validateData($this->response_data, $signature, $this->SMARTCOOK["secret"]);
    }

    public function printResponse(): static
    {
        echo "Response:\n" . json_encode(
            $this->getResponseData(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ) . "\nResponse verified: " . ($this->validateResponseData() ? "yes" : "no");
        return $this;
    }

    public static function createSignature(array $data, string $secret): string
    {
        return hash_hmac("SHA256", json_encode($data, JSON_INVALID_UTF8_IGNORE), $secret);
    }

    public static function validateData(array $data, string $signature, string $secret): bool
    {
        return hash_hmac("SHA256", json_encode($data, JSON_INVALID_UTF8_IGNORE), $secret) === $signature;
    }

}