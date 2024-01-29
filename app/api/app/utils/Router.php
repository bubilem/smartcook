<?php

class Router
{
    public static function route(): void
    {
        $req = new RequestModel;
        $endpoint = $req->getUrlParam(0);
        switch ($endpoint) {
            case 'echo':
            case 'structure':
            case 'recipe':
            case 'recipe-add':
            case 'recipe-validate':
            case 'recipe-remove':
            case 'recipes':
            case 'test':
                echo new(str_replace("-", "", ucwords($endpoint, "-")) . "Controller")(req: $req);
                break;
            default:
                echo new DefaultController(req: $req);
        }
    }
}
