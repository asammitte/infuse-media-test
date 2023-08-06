<?php

namespace Core\User\Commands\CreateUser;

class CreateUserModel
{
    public string $name;
    public ?string $email;
    public int $age;
    public ?int $gender;
    public bool $subscribe;
}
