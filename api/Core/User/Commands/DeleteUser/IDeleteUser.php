<?php

namespace Core\User\Commands\DeleteUser;

interface IDeleteUser
{
    public function execute(DeleteUserModel $model): bool;
}
