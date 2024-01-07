<?php

class EchoController extends MainController
{

    public function do (): void
    {
        $data = $this->req->get();
        if (empty($data)) {
            throw new Exception("no data to echo");
        }
        $this->res
            ->set('stat', 'ok')
            ->set('data', $data);
    }

}
