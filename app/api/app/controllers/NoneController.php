<?php

class NoneController extends MainController
{

    public function run(): void
    {
        echo (string) $this->res
            ->set('stat', 'ok')
            ->set('mess', "No or not supported operation.")
            ->set('docu', "https://github.com/bubilem/smartcook/tree/main/docs/api");
    }

}
