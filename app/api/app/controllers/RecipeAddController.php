<?php

class RecipeAddController extends MainController
{

    public function do(): void
    {
        $recipe = new RecipeModel(
            data: $this->req->get("data"),
            strc: new StructureModel,
            user: $this->req->getUser()
        );
        $recipe->validate();
        DB::query(
            "INSERT INTO recipe (name, difficulty, duration, price, description, country, author) "
            . "VALUES (:name, :difficulty, :duration, :price, :description, :country, :author)",
            [
                'name' => (string) $recipe->get("name"),
                'difficulty' => (int) $recipe->get("difficulty"),
                'duration' => (int) $recipe->get("duration"),
                'price' => (int) $recipe->get("price"),
                'description' => (string) $recipe->get("description"),
                'country' => (string) $recipe->get("country"),
                'author' => (string) $recipe->get("author")
            ]
        );
        $id = DB::lastInsertId();
        if (!$id) {
            throw new Exception("Recipe add: error while inserting recipe record");
        }
        $this->res
            ->set('stat', 'ok')
            ->set('mess', "Recipe (new id=$id) is saved");
    }
}
