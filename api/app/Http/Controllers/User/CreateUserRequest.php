<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\FormRequest;
use Core\User\Commands\CreateUser\CreateUserModel;
use Domain\Enums\UserAgeEnum;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // So here I would use only simple validations like: type check, required, length and etc 
        // BUT business logic validation (like, we can have only unique emails or 
        // create/update/delete permission etc) in real project I would move to
        // Core\User\Commands\CreateUser\CreateUserValidator or
        // Core\User\Commands\CreateUser\CreateUser command and will run before command execute.
        // So I would prevent Laravel Model magic and in general ActiveRecord pattern
        return [
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|email:filter|unique:users',
            'age' => [
                'required',
                Rule::in(UserAgeEnum::values())
            ],
            'gender' => 'required|boolean',
            'subscribe' => 'required|boolean'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'email.unique' => 'Email already exists'
        ];
    }

    public function data(): CreateUserModel
    {
        $model = new CreateUserModel();
        $model->name = $this->input('name');
        $model->email = $this->input('email');
        $model->age = intval($this->input('age'));
        $model->gender = boolval($this->input('gender'));
        $model->subscribe = boolval($this->input('subscribe'));
        return $model;
    }
}
