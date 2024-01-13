<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function registration(RegisterRequest $request, EmailService $emailService)
    {
        $isExists = User::query()->select('login', 'email')->exists();

        if ($isExists) {
            return redirect()->back()->withErrors([
                'error-register' => 'Пользователь с таким логином или почтой уже существует'
            ]);
        }

        $user = $this->authService->registration($request->all());
        $emailService->sendEmailConfirm($user['email'], $user['id']);
        Auth::login($user);

        return redirect('/panel');
    }

    public function emailVerify(Request $request)
    {
        $authService = $this->authService->verifyEmail($request->all());

        if ($authService) {
            return redirect('/panel')->with(['email-verify' => 'Электронная почта успешна подтверждена']);
        }

        abort(404);
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/panel');
        }

        return view('auth.login');
    }

    public function auth(LoginRequest $request)
    {
        $authService = $this->authService->auth($request->only('login', 'password'));

        if ($authService) {
            return redirect('/panel');
        }

        return redirect()->back()->withErrors(['login-error' => 'Неверные логин или пароль']);
    }
}
