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

    public function insertToDb(): static
    {
        try {
            DB::query("START TRANSACTION");
            DB::query(
                "INSERT INTO recipe (name, difficulty, duration, price, description, country, author) "
                . "VALUES (:name, :difficulty, :duration, :price, :description, :country, :author)",
                [
                    'name' => (string) $this->get("name"),
                    'difficulty' => (int) $this->get("difficulty"),
                    'duration' => (int) $this->get("duration"),
                    'price' => (int) $this->get("price"),
                    'description' => (string) $this->get("description"),
                    'country' => (string) $this->get("country"),
                    'author' => (string) $this->get("author")
                ]
            );
            $id = (int) DB::lastInsertId();
            if (!$id) {
                throw new Exception("Recipe add: error while inserting recipe record");
            }
            $this->set("id", $id);

            foreach ((array) $this->get("dish_category") as $val) {
                DB::query(
                    "INSERT INTO recipe_has_dish_category (recipe_id, dish_category_id) VALUES (:r, :c)",
                    [
                        'r' => (int) $this->get("id"),
                        'c' => (int) $val
                    ]
                );
            }

            foreach ((array) $this->get("recipe_category") as $val) {
                DB::query(
                    "INSERT INTO recipe_has_category (recipe_id, recipe_category_id) VALUES (:r, :c)",
                    [
                        'r' => (int) $this->get("id"),
                        'c' => (int) $val
                    ]
                );
            }

            foreach ((array) $this->get("tolerance") as $val) {
                DB::query(
                    "INSERT INTO recipe_has_tolerance (recipe_id, tolerance_id) VALUES (:r, :t)",
                    [
                        'r' => (int) $this->get("id"),
                        't' => (int) $val
                    ]
                );
            }

            $rota = 1;
            foreach ((array) $this->get("ingredient") as $val) {
                $ingr = new IngredientModel($val, $this->strc);
                $ingr->validate();
                if (!$ingr->get("id")) {
                    $ingr->insertToDb();
                }
                DB::query(
                    "INSERT INTO recipe_has_ingredient (recipe_id, ingredient_id, quantity, unit, necessary, rota, comment) "
                    . "VALUES (:recipe_id, :ingredient_id, :quantity, :unit, :necessary, :rota, :comment)",
                    [
                        'recipe_id' => (int) $this->get("id"),
                        'ingredient_id' => (int) $ingr->get("id"),
                        'quantity' => $ingr->get("quantity"),
                        'unit' => (string) $ingr->get("unit"),
                        'necessary' => (int) $ingr->get("necessary"),
                        'rota' => $rota++,
                        'comment' => $ingr->get("comment") ? (string) $ingr->get("comment") : null,
                    ]
                );
            }

            DB::query("COMMIT");
        } catch (Exception $e) {
            DB::query("ROLLBACK");
            throw new Exception($e->getMessage());
        }
        return $this;
    }

    public function validate(): static
    {
        if (empty($this->data)) {
            throw new Exception("Recipe: no recipe data");
        }
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
        if (!isset($this->data['tolerance']) || !is_array($this->data['tolerance'])) {
            throw new Exception("Recipe: tolerance is missing or is not array/list");
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
        return $this;
    }

}