<?php

namespace Infrastructure\Repository;

use Core\Repository\IRepository;
use Illuminate\Database\Eloquent\Builder;

abstract class Repository implements IRepository
{
    protected Builder $query;

    public function __construct()
    {
        $this->begin();
    }

    abstract protected function model(): string;

    protected function begin(): self
    {
        /* @var \Illuminate\Database\Eloquent\Model $model */
        $class = $this->model();
        $model = new $class();
        $this->query = $model->newQuery();
        return $this;
    }
}
