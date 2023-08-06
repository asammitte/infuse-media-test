<?php

namespace Core\Common\Dto;

class PaginatedModelDto
{
    public Array $data;
    public PaginationModel $pagination;

    public function __construct(
        Array $data,
        int $pageIndex,
        int $pageSize,
        int $totalItems
    ) {
        $this->data = $data;
        $this->pagination = new PaginationModel($pageIndex, $pageSize, $totalItems);
    }
}

class PaginationModel
{
    public int $pageIndex;
    public int $pageSize;
    public int $totalItems;
    public ?int $itemsOnPage;
    public int $totalPages;
    public bool $hasPrevious;
    public bool $hasNext;

    public function __construct(
        int $pageIndex,
        int $pageSize,
        int $totalItems
    ) {
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize;
        $this->totalItems = $totalItems;

        $this->totalPages = $this->getTotalPages();
        $this->hasPrevious = $this->getHasPrevious();
        $this->hasNext = $this->getHasNext();
    }

    public function getTotalPages(): int
    {
        return ceil($this->totalItems / (float) $this->pageSize);
    }

    public function getHasPrevious(): bool
    {
        return $this->pageIndex > 1;
    }

    public function getHasNext(): bool
    {
        return $this->pageIndex < $this->getTotalPages();
    }

    // public function getPageIndex(): int
    // {
    //     return $this->requestPageIndex + 1;
    // }
}
