<?php

class EchoController extends MainController
{

    public function run(): void
    {
        try {
            $this->req->verify();
            $this->res
                ->set('stat', 'ok')
                ->set('data', $this->req->get());
        } catch (Exception $e) {
            $this->res
                ->set('stat', 'fail')
                ->set('mess', $e->getMessage());
        }
        echo (string) $this->res;
    }

}
