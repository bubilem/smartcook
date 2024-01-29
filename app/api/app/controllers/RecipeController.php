<?php

class RecipeController extends MainController
{

    public function do(): void
    {
        $id = (int) $this->req->getUrlParam(1);
        if (!$id) {
            throw new Exception("No recipe id.");
        }
        $recipe = (new RecipeModel(strc: new StructureModel))->fullLoadFromDb($id);
        $this->res
            ->set('stat', 'ok')
            ->set('data', $recipe->dataToExport());
    }

}
