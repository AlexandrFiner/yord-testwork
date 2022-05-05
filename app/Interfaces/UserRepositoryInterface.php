<?php

namespace App\Interfaces;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface {
    public function login(Request $request);
    public function register(Request $request);
    public function find($id);
}