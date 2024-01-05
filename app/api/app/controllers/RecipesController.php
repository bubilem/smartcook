<?php

class RecipesController extends MainController
{

    public function run(): void
    {
        try {
            $q = "SELECT id, name FROM recipe ORDER BY name";
            $recipes = DB::query($q)->fetchAll();
            $this->res
                ->set('stat', 'ok')
                ->set('data', $recipes);
        } catch (Exception $e) {
            $this->res
                ->set('stat', 'fail')
                ->set('mess', $e->getMessage());
        }
        echo (string) $this->res;
    }

}
