<?php

namespace Core\User\Dtos;

use Domain\User\User;

class UserPaginationItemDto
{
    public int $id;
    public string $name;
    public string $email;
    public int $age;
    public bool $gender;
    public bool $isSubscribed;

    /**
     * Converts User attributes to UserPaginationItemDto
     * 
     * @param User $model
     * @return UserPaginationItemDto
     */
    public function fromUser(User $user): UserPaginationItemDto
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

        if ($user->profile)
        {
            $this->age = $user->profile->age;
            $this->gender = $user->profile->gender;
            $this->isSubscribed = $user->profile->is_subscribed;
        }

        return $this;
    }
}
