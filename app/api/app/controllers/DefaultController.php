<?php

class DefaultController extends MainController
{

    public function do (): void
    {
        $this->res
            ->set('stat', 'ok')
            ->set('mess', "No or not supported operation.")
            ->set('docu', "https://github.com/bubilem/smartcook/tree/main/docs/api");
    }

}
