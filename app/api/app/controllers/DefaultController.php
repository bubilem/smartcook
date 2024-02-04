<?php

class DefaultController extends MainController
{

    public function do(): void
    {
        $this->res
            ->set('stat', 'ok')
            ->set('mess', "No or not supported operation.")
            ->set('data', [
                "name" => "SmartCook Erasmus+ project",
                "school_url" => "https://skolavdf.cz",
                "doc_url" => "https://github.com/bubilem/smartcook/tree/main/docs/api"
            ]);
    }

}
