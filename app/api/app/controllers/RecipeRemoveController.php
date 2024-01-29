<?php

class RecipeRemoveController extends MainController
{

    public function do(): void
    {
        $recipe_id = (int) $this->req->get("recipe_id");
        if (!$recipe_id) {
            throw new Exception("No recipe_id!");
        }

        (new RecipeModel(strc: new StructureModel, user: $this->req->getUser()))
            ->loadFromDb($recipe_id)
            ->validateAuthor()
            ->removeFromDb();

        $this->res
            ->set('stat', 'ok')
            ->set('mess', "Recipe id=$recipe_id was removed");
    }
}
