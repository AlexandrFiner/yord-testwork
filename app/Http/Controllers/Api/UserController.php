<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\UserRepositoryInterface;
use F9Web\ApiResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponseHelpers;

    public UserRepositoryInterface $user;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index() {
        return $this->respondWithSuccess(Auth::user());
    }

    public function login(Request $request) {
        if($user = $this->user->login($request)) {
            $token = $user->createToken('api_token');

            return $this->respondWithSuccess([
                'token' => $token->plainTextToken,
            ]);
        }

        return $this->respondError('wrong data');
    }

    public function register(Request $request) {
        if($user = $this->user->register($request)) {
            $token = $user->createToken('api_token');

            return $this->respondWithSuccess([
                'token' => $token->plainTextToken,
            ]);
        }

        return $this->respondError('wrong data');
    }
}
