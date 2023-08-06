<?php

namespace Core\User\Commands\CreateUser;

use Core\User\Dtos\UserPaginationItemDto;
use Core\User\Repositories\IUserRepository;

class CreateUser implements ICreateUser
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateUserModel $model): UserPaginationItemDto | null
    {
        $source = $this->repository->create($model);

        if ($source) {
            $dto = new UserPaginationItemDto();
            $user = $dto->fromUser($source);
            return $user;
        }

        return null;
    }
}
