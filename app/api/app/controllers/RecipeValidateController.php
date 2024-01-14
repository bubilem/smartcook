<?php

class RecipeValidateController extends MainController
{

    public function do(): void
    {
        $recipe = new RecipeModel(
            data: (array) $this->req->get("data"),
            strc: new StructureModel,
            user: $this->req->getUser()
        );
        $recipe->validate();
        $this->res
            ->set('stat', 'ok')
            ->set('mess', "Recipe is valid");
    }

}