<?php

class ImageController extends MainController
{

    public function do(): void
    {
        $file = __DIR__ . "/../../img/" . $this->req->getUrlParam(1);
        if (!file_exists($file)) {
            $file = __DIR__ . "/../../img/0.webp";
        }
        header("Content-Type: image/webp");
        readfile($file);
        exit;
    }

}
