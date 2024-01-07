<?php

class RequestModel extends MainModel
{
    private array $urlParams;

    private ?UserModel $user;

    public function __construct()
    {
        $this->urlParams = explode(
            "/",
            trim(
                preg_replace(
                    "~^" . URI_BASE . "~",
                    "",
                    filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL)
                ),
                "/"
            )
        );
        $this->data = $this->getPost();
        $this->user = $this->detectUser();
        if (!empty($this->get())) {
            $this->validate();
        }
    }

    public function getUrlParam(int $index): string
    {
        return $this->urlParams[$index] ?? "";
    }

    public function getPost(): array
    {
        $post = json_decode(file_get_contents("php://input"), true);
        if (json_last_error() != JSON_ERROR_NONE || !is_array($post)) {
            return [];
        }
        return $post;
    }

    public function getUser(): ?UserModel
    {
        return $this->user;
    }

    public function detectUser(): ?UserModel
    {
        return $this->get("user")
            ? new UserModel($this->get("user"))
            : null;
    }

    public function validate(): bool
    {
        if ($this->user === null) {
            throw new Exception("No user.");
        }
        if (empty($this->data["time"])) {
            throw new Exception("The time attribute is missing.");
        }
        if (!is_int($this->data["time"])) {
            throw new Exception("The time attribute value is not a number.");
        }
        if ($this->data["time"] < time() - 10 || $this->data["time"] > time() + 10) {
            throw new Exception("The time is not around now (tolerance 10 seconds).");
        }
        if (empty($this->data["sign"])) {
            throw new Exception("The sign attribute for signature is missing.");
        }
        $signature = $this->data["sign"];
        unset($this->data["sign"]);
        if (!Signature::validate($this->data, $signature, $this->user->get("secret"))) {
            throw new Exception("The signature doesn't match.");
        }
        return true;
    }
}
