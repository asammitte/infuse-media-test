<?php

namespace App\Http\Controllers\User;

use Core\User\Queries\GetUserPagination\GetUserPaginationModel;
use Illuminate\Foundation\Http\FormRequest;

class GetUserPaginationRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function data(): GetUserPaginationModel
    {
        return new GetUserPaginationModel(
            $this->query('pageIndex', 1),
            $this->query('pageSize', 50),
        );
    }
}
