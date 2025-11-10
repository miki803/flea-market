<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    //use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *新規ユーザー作成（/register POST 時に呼ばれる）
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
         // ここで登録フォームのバリデーションを定義
        Validator::make($input, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // ← confirmed が password_confirmation を見る
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
