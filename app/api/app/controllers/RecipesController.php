<?php

class RecipesController extends MainController
{

    public function do(): void
    {
        $q = "SELECT id, name, author FROM recipe ORDER BY name";
        $recipes = DB::query($q)->fetchAll();
        $this->res
            ->set('stat', 'ok')
            ->set('data', $recipes);
    }

}
