<?php

namespace App\Repositories;

use App\Http\Requests\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {

    public function login(Request $request) {
        $validator = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ], [
            'email.required' => 'Вы не указали почту',
            'password.required' => 'Вы не указали пароль'
        ]);

        try {
            $user = User::where('email', $request['email'])->firstOrFail();
            if(Hash::check($request['password'], $user->password))
                return $user;

            return false;
        } catch (ModelNotFoundException $ex) {
            return false;
        }
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
        ], [
            'email.required' => 'Вы не указали почту',
            'email.unique' => 'Почта уже используется',
            'password.required' => 'Вы не указали пароль'
        ]);

        return User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
    }

    public function find($id) {

    }
}