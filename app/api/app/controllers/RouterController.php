<?php

class RouterController extends MainController
{
    public function run(): void
    {
        $endpoint = $this->req->getUrlParam(0);
        switch ($endpoint) {
            case 'echo':
            case 'structure':
            case 'recipe':
            case 'recipe-add':
            case 'recipes':
            case 'test':
                (
                    new(str_replace("-", "", ucwords($endpoint, "-")) . "Controller")(
                        $this->req,
                        $this->res
                    )
                )->run();
                break;
            default:
                (new NoneController($this->req, $this->res))->run();
        }
    }
}
