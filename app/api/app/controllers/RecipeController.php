<?php

class RecipeController extends MainController
{

    public function run(): void
    {
        try {
            $id = (int) $this->req->getUrlParam(1);
            if (!$id) {
                throw new Exception("No recipe id.");
            }
            $q = "SELECT * FROM recipe WHERE id = $id";
            $recipe = DB::query($q)->fetchAll();
            if (empty($recipe[0])) {
                throw new Exception("Recipe not found.");
            }
            $this->res
                ->set('stat', 'ok')
                ->set('data', $recipe[0]);
        } catch (Exception $e) {
            $this->res
                ->set('stat', 'fail')
                ->set('mess', $e->getMessage());
        }
        echo (string) $this->res;
    }

}
