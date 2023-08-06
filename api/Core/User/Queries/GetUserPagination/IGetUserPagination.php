<?php

namespace Core\User\Queries\GetUserPagination;

use Core\Common\Dto\PaginatedModelDto;

interface IGetUserPagination
{
    public function execute(GetUserPaginationModel $model): PaginatedModelDto;
}
