<?php

namespace Core\User\Commands\CreateUser;

use Core\User\Dtos\UserPaginationItemDto;

interface ICreateUser
{
    /**
     * @param CreateUserModel $model
     * @return UserPaginationItemDto|null
     */
    public function execute(CreateUserModel $model): UserPaginationItemDto | null;
}
