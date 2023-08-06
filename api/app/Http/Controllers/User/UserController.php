<?php

namespace App\Http\Controllers\User;

use \Illuminate\Http\JsonResponse;
use Core\User\Commands\CreateUser\ICreateUser;
use Core\User\Commands\DeleteUser\IDeleteUser;
use Core\User\Queries\GetUserPagination\IGetUserPagination;
use App\Http\Controllers\Controller;
use Core\User\Commands\DeleteUser\DeleteUserModel;

class UserController extends Controller
{
    /**
     * @param IGetUserPagination $query
     * @param GetUserPaginationRequest $request
     * @return JsonResponse
     */
    public function index(GetUserPaginationRequest $request, IGetUserPagination $query): JsonResponse
    {
        $paginatedUsers = $query->execute($request->data());
        return response()->json($paginatedUsers);
    }

    /**
     * @param CreateUserRequest $request
     * @param ICreateUser $command
     * @return JsonResponse
     */
    public function create(CreateUserRequest $request, ICreateUser $command): JsonResponse
    {
        $result = $command->execute($request->data());
        return response()->json($result);
    }

    /**
     * @param int $id
     * @param IDeleteUser $command
     * @return JsonResponse
     */
    public function delete(int $id, IDeleteUser $command): JsonResponse
    {
        $deleteUserModel = new DeleteUserModel($id);
        $result = $command->execute($deleteUserModel);
        return response()->json($result);
    }
}
