<?php

class RecipeValidateController extends MainController
{

    public function do(): void
    {
        (
            new RecipeModel(
                data: (array) $this->req->get("data"),
                strc: new StructureModel,
                user: $this->req->getUser()
            )
        )
            ->validate()
            ->validateAuthor();

        $this->res
            ->set('stat', 'ok')
            ->set('mess', "Recipe is valid");
    }

}