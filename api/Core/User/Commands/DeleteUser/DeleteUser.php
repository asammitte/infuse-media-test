<?php

namespace Core\User\Commands\DeleteUser;

use Core\User\Repositories\IUserRepository;

class DeleteUser implements IDeleteUser
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(DeleteUserModel $model): bool
    {
        return $this->repository->delete($model->getUserId());
    }
}
