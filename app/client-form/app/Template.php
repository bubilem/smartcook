<?php

class Template
{
    private string $tmplt;
    private array $data;

    public function __construct(string $name, array $data = [])
    {
        $this->tmplt = file_get_contents("templates/$name.html");
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

    public function __toString(): string
    {
        return $this->render();
    }

}