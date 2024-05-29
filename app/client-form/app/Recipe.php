<?php

class Recipe
{
    public array $data;

    public function __construct(array $data = [])
    {
        $this->data = json_decode(file_get_contents("data/recipe.json"), true);

    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? "";
    }

    public function __set(string $name, $value)
    {
        $this->data[$name] = $value;
    }
}