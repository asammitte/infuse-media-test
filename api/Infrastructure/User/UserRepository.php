<?php

namespace Infrastructure\User;

use Core\User\Commands\CreateUser\CreateUserModel;
use Core\User\Queries\GetUserPagination\GetUserPaginationModel;
use Core\User\Repositories\IUserRepository;
use Domain\User\Profile;
use Domain\User\User;
use Exception;
use Infrastructure\Repository\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRepository extends Repository implements IUserRepository
{
    protected function model(): string
    {
        return User::class;
    }

    /**
     * So ideally this should return plain User class
     * and not Illuminate\Database\Eloquent\Model
     * so we can freely switch repository realisation
     * without relying on Laravel dependency
     * By returning Illuminate\Database\Eloquent\Collection
     * our Commands and Queries and also Dtos become
     * hostages of specific library classes. But this is
     * disscussable during project architecture planning.
     * For now I will leave this as Laravel Collection,
     * but for more flexible and extendable app I will go
     * with returning array of plain Domain Entities
     * 
     * @param GetUserPaginationModel $model
     * @return User[]
     */
    public function getPaginated(GetUserPaginationModel $model): Collection
    {
        $skip = ($model->pageIndex - 1) * $model->pageSize;
        $retVal = $this->query
                    ->with(['profile' => function ($query) {
                        $query->select('user_id', 'age', 'gender', 'is_subscribed');
                    }])
                    ->select('id', 'name', 'email')
                    ->orderBy('id', 'DESC')
                    ->skip($skip)
                    ->take($model->pageSize)
                    ->get();

        return $retVal;
    }

    /**
     * Create user and related Profile records
     * 
     * @param CreateUserModel $model
     * @return User
     */
    public function create(CreateUserModel $model): User
    {
        $userModel = [
            'name' => $model->name,
            'email' => $model->email,
            'password' => Str::random(10)
        ];

        $profileModel = [
            'age' => $model->age,
            'gender' => $model->gender,
            'is_subscribed' => $model->subscribe,
        ];

        // There is need create some centralized exception processing
        // But for test task I'll skip this step
        try {
            DB::beginTransaction();
            $user = User::create($userModel);
            $profile = new Profile($profileModel);
            $user->profile()->save($profile);
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            abort(500, 'User creating failed.');
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $recordsDeleted = DB::table('users')
            ->where('id', $id)
            ->delete();

        return boolval($recordsDeleted);
    }
}
