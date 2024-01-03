<?php

abstract class MainModel
{
    protected array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function set(string $key, string|int|array $value): static
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function get(string $key = null): string|int|array|null
    {
        return $key === null
            ? $this->data
            : $this->data[$key] ?? null;
    }
}
