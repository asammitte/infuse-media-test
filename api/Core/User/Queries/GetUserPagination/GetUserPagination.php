<?php

namespace Core\User\Queries\GetUserPagination;

use Core\Common\Dto\PaginatedModelDto;
use Core\User\Repositories\IUserRepository;
use Core\User\Dtos\UserPaginationItemDto;

class GetUserPagination implements IGetUserPagination
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetUserPaginationModel $model): PaginatedModelDto
    {
        // here I do not want to use Illuminate\Contracts\Pagination\LengthAwarePaginator
        // because in PHP we do not have generic types
        // I do not want additionally check type of object instances in LengthAwarePaginator->items()
        $source = $this->repository->getPaginated($model);

        $items = [];
        foreach($source as $user)
        {
            $dto = new UserPaginationItemDto();
            $items[] = $dto->fromUser($user);
        }

        // I'll fake total records request
        $totalItems = 42;

        $paginatedModel = new PaginatedModelDto(
            $items,
            $model->pageIndex,
            $model->pageSize,
            $totalItems
        );

        return $paginatedModel;
    }
}
