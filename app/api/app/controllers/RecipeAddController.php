<?php

class RecipeAddController extends MainController
{

    public function run(): void
    {
        try {
            $datastruct = json_decode(file_get_contents("data/structure.json"), true);
            $db = new DBDriver;
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
