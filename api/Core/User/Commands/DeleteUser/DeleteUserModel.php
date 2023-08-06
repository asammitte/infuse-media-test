<?php

namespace Core\User\Commands\DeleteUser;

class DeleteUserModel
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        // with dynamic typisation and without strict mode
        // you never know, so to be sure
        // let's use intval =)
        $userId = intval($this->id);

        return $userId;
    }
}
