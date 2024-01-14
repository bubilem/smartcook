<?php

class RecipeAddController extends MainController
{

    public function do(): void
    {
        $recipe = new RecipeModel(
            data: (array) $this->req->get("data"),
            strc: new StructureModel,
            user: $this->req->getUser()
        );
        $recipe
            ->validate()
            ->insertToDb();
        $this->res
            ->set('stat', 'ok')
            ->set('mess', "Recipe (new id=" . $recipe->get("id") . ") is saved");
    }
}
