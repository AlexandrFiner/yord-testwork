<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use phpDocumentor\Reflection\Location;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->users = $userRepository;
    }

    public function login(Request $request) {
        if($request->isMethod('post')) {
            if($user = $this->users->login($request)) {
                Auth::login($user, true);
                return redirect('/chat');
            }

            return redirect()->back()->withInput($request->only('email'))->withErrors(['Неверный логин и/или пароль']);
        }
        return view('auth.login');
    }

    public function register(Request $request) {
        if($request->isMethod('post')) {
            if($user = $this->users->register($request)) {
                Auth::login($user, true);
                return redirect('/chat');
            }

            return redirect()->back()->withInput($request->only('email'));
        }
        return view('auth.register');
    }
}
