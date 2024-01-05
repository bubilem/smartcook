<?php

class StructureModel extends MainModel
{

    public function __construct()
    {
        $this->data = json_decode(
            file_get_contents("data/structure.json"),
            true
        );
    }

}