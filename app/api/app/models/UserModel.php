<?php

class UserModel extends MainModel
{
    public function __construct(int $id = 0)
    {
        parent::__construct();
        $this->load($id);
    }

    public function load(int $id): bool
    {
        $data = json_decode(file_get_contents(DIR_DATA . "/users.json"), true);
        $this->data = $data[$id] ?? [];
        return true;
    }
}
