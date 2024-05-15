<?php

class Template
{
    private string $tmplt;
    private array $data;

    public function __construct(string $file, array $data = [])
    {
        $this->tmplt = file_get_contents($file);
        $this->data = $data;
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function render(): string
    {
        $tmplt = $this->tmplt;
        foreach ($this->data as $key => $value) {
            $tmplt = str_replace("{{$key}}", (string) $value, $tmplt);
        }
        return $tmplt;
    }

}