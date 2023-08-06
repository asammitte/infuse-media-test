<?php

namespace Core\User\Repositories;

use Core\User\Commands\CreateUser\CreateUserModel;
use Core\User\Queries\GetUserPagination\GetUserPaginationModel;
use Core\Repository\IRepository;
use Domain\User\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository extends IRepository
{
    /**
     * @param GetUserPaginationModel $model
     * @return User[]
     */
    public function getPaginated(GetUserPaginationModel $model): Collection;

    /**
     * @param CreateUserModel $model
     * @return User
     */
    public function create(CreateUserModel $model): User;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
