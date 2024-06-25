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
            ->userToAuthor()
            ->insertToDb();
        $this->res
            ->set('stat', 'ok')
            ->set('mess', "Recipe has been added")
            ->set('data', ['recipe_id' => (int) $recipe->get("id")]);
    }
}
