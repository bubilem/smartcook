<?php

class StructureModel extends MainModel
{

    public function __construct()
    {
        $this->data = json_decode(
            file_get_contents("data/structure.json"),
            true
        );
    }

    public function keyExists(int|string $key, string $attribute): bool
    {
        return isset($this->data[$attribute][$key]);
    }

    public function keysExist(array $keys, string $attribute): bool
    {
        $exist = true;
        foreach ($keys as $key) {
            if (!$this->keyExists($key, $attribute)) {
                return false;
            }
        }
        return $exist;
    }

}