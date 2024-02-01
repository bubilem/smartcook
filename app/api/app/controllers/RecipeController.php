<?php

class RecipeController extends MainController
{

    public function do(): void
    {
        $recipe_id = (int) $this->req->get("recipe_id");
        if (!$recipe_id) {
            throw new Exception("No recipe_id!");
        }

        $recipe = (new RecipeModel(strc: new StructureModel))->fullLoadFromDb($recipe_id);
        $this->res
            ->set('stat', 'ok')
            ->set('data', $recipe->dataToExport());
    }

}
