<?php

class RecipeModel extends MainModel
{

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function verify(): bool
    {
        if (empty($this->data['name'])) {
            throw new Exception("Name is missing or empty.");
        }
        $result = DB::query(
            "SELECT id FROM recipe WHERE name = :name",
            ["name" => $this->data['name']]
        )->fetchAll();
        if (!empty($result)) {
            throw new Exception("Such a name already exists in the database.");
        }
        return true;
    }

}