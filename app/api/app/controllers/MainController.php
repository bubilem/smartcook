<?php

abstract class MainController
{

    protected RequestModel $req;
    protected ResponseModel $res;

    public function __construct(RequestModel $req = null, ResponseModel $res = null)
    {
        $this->req = $req ?? new RequestModel;
        $this->res = $res ?? new ResponseModel;
    }

    public abstract function do(): void;

    public function __toString(): string
    {
        try {
            $this->do();
        } catch (Exception $e) {
            $this->res
                ->set('stat', 'fail')
                ->set('mess', $e->getMessage());
        }
        return (string) $this->res;
    }
}
