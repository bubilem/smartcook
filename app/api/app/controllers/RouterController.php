<?php

class RouterController extends MainController
{
    public function run(): void
    {
        switch ($this->req->getUrlParam(0)) {
            case 'echo':
                (new EchoController(req: $this->req, res: $this->res))->run();
                break;
            case 'structure':
                (new StructureController(req: $this->req, res: $this->res))->run();
                break;
            default:
                (new NoneController(req: $this->req, res: $this->res))->run();
        }
    }
}
