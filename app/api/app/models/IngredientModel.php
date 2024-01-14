<?php

class IngredientModel extends MainModel
{
    private ?StructureModel $strc;

    public function __construct(
        array $data = [],
        ?StructureModel $strc = null,
    ) {
        $this->data = $data;
        $this->strc = $strc;
    }

    public function insertToDb(): static
    {
        DB::query(
            "INSERT INTO ingredient (name) VALUES (:name)",
            ['name' => (string) $this->get("name")]
        );
        $id = (int) DB::lastInsertId();
        if (!$id) {
            throw new Exception("Ingredient add: error while inserting ingredient record");
        }
        $this->set("id", $id);
        return $this;
    }

    public static function getIdByName(string $name): int
    {
        $result = DB::query(
            "SELECT id FROM ingredient WHERE name = :name",
            ["name" => $name]
        )->fetchAll();
        return (int) ($result[0]["id"] ?? 0);
    }

    public function validate(): static
    {
        if (!empty($this->data['id'])) {
            if (!is_numeric($this->data['id'])) {
                throw new Exception("Ingredient: id (" . $this->data['id'] . ") is not numeric");
            }
            $result = DB::query(
                "SELECT id FROM ingredient WHERE id = :id",
                ["id" => (int) $this->data['id']]
            )->fetchAll();
            if (empty($result)) {
                throw new Exception("Ingredient: no such id (" . (int) $this->data['id'] . ") in database");
            }
        }
        if (empty($this->data['name'])) {
            throw new Exception("Ingredient: name is missing");
        }
        if ($id = self::getIdByName($this->data["name"])) {
            $this->set("id", $id);
        }
        if (empty($this->data['quantity'])) {
            throw new Exception("Ingredient: quantity is missing");
        }
        if (!is_numeric($this->data['quantity'])) {
            throw new Exception("Ingredient: quantity is not numeric");
        }
        if (empty($this->data['unit'])) {
            throw new Exception("Ingredient: unit is missing");
        }
        if (!$this->strc?->keyExists($this->data['unit'], "unit")) {
            throw new Exception("Ingredient: unit has incorrect value");
        }
        return $this;
    }

}