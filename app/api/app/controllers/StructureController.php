<?php

class StructureController extends MainController
{

    public function run(): void
    {
        echo (string) $this->res
            ->set('stat', 'ok')
            ->set('data', json_decode(file_get_contents("data/structure.json"), true));
    }

}
