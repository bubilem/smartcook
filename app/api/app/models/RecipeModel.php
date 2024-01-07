<?php

class RecipeModel extends MainModel
{
    private bool $valid;
    private ?StructureModel $strc;
    private ?UserModel $user;

    public function __construct(
        array $data = [],
        ?StructureModel $strc = null,
        ?UserModel $user = null
    ) {
        $this->valid = false;
        $this->data = $data;
        $this->strc = $strc;
        $this->user = $user;
    }

    public function validate(): bool
    {
        if (empty($this->data['author'])) {
            throw new Exception("Recipe: author is missing");
        }
        if ($this->data['author'] != $this->user->get("name")) {
            throw new Exception("Recipe: author of the recipe does not match the sender of the request");
        }
        if (empty($this->data['name'])) {
            throw new Exception("Recipe: name is missing or empty");
        }
        $result = DB::query(
            "SELECT id FROM recipe WHERE name = :name",
            ["name" => $this->data['name']]
        )->fetchAll();
        if (!empty($result)) {
            throw new Exception("Recipe: such a name already exists in the database");
        }
        if (empty($this->data['difficulty'])) {
            throw new Exception("Recipe: difficulty is missing or empty");
        }
        if (!$this->strc->keyExists($this->data['difficulty'], "difficulty")) {
            throw new Exception("Recipe: difficulty has incorrect value");
        }
        if (empty($this->data['duration'])) {
            throw new Exception("Recipe: duration is missing or empty");
        }
        if (!(int) $this->data['duration']) {
            throw new Exception("Recipe: duration has incorrect value");
        }
        if (empty($this->data['price'])) {
            throw new Exception("Recipe: price is missing or empty");
        }
        if (!$this->strc->keyExists($this->data['price'], "price")) {
            throw new Exception("Recipe: price has incorrect value");
        }
        if (empty($this->data['description'])) {
            throw new Exception("Recipe: description is missing or empty");
        }
        if (empty($this->data['country'])) {
            throw new Exception("Recipe: country is missing or empty");
        }
        if (strlen($this->data['country']) != 2) {
            throw new Exception("Recipe: country format is not ISO 3166 alpha-2");
        }
        if (empty($this->data['dish_category']) || !is_array($this->data['dish_category'])) {
            throw new Exception("Recipe: dish_category is missing/empty or is not array/list");
        }
        if (!$this->strc->keysExist($this->data['dish_category'], "dish_category")) {
            throw new Exception("Recipe: dish_category has incorrect value");
        }
        if (empty($this->data['recipe_category']) || !is_array($this->data['recipe_category'])) {
            throw new Exception("Recipe: recipe_category is missing/empty or is not array/list");
        }
        if (!$this->strc->keysExist($this->data['recipe_category'], "recipe_category")) {
            throw new Exception("Recipe: recipe_category has incorrect value");
        }
        if (empty($this->data['tolerance']) || !is_array($this->data['tolerance'])) {
            throw new Exception("Recipe: tolerance is missing/empty or is not array/list");
        }
        if (!$this->strc->keysExist($this->data['tolerance'], "tolerance")) {
            throw new Exception("Recipe: tolerance has incorrect value");
        }
        if (empty($this->data['ingredient']) || !is_array($this->data['ingredient'])) {
            throw new Exception("Recipe: ingredient is missing/empty or is not array/list");
        }
        foreach ($this->data["ingredient"] as $value) {
            $ingredient = new IngredientModel($value, $this->strc);
            $ingredient->validate();
        }
        return true;
    }

}