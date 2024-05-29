<?php

class IngredientsController extends MainController
{

    public function do(): void
    {
        $query = "SELECT i.id, name, COUNT(ingredient_id) 'number_of_uses' FROM ingredient i LEFT JOIN recipe_has_ingredient ON i.id = ingredient_id GROUP BY i.id ORDER BY name";
        $ingredients = DB::query($query)->fetchAll();
        $this->res
            ->set('stat', 'ok')
            ->set('data', $ingredients);
    }

}
