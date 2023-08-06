<?php

namespace Core\User\Queries\GetUserPagination;

class GetUserPaginationModel
{
    public int $pageIndex = 1;
    public ?int $pageSize;

    public function __construct(int $pageIndex, ?int $pageSize)
    {
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize <= 50 ? $pageSize : 50;
    }

}
