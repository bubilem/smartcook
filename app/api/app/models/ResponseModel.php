<?php

class ResponseModel extends MainModel
{
    private UserModel $user;

    protected string $state = "ok";

    public function __construct()
    {
        parent::__construct();
        $this->user = new UserModel;
    }

    public function __toString()
    {
        $this->set('user', (int) $this->user->get("id"));
        $this->set('time', (int) Date::now());
        $this->set('sign', Signature::create($this->data, $this->user->get("secret")));
        return json_encode($this->data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
