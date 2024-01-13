<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registration(RegisterRequest $request, EmailService $emailService)
    {
        $user = $this->authService->registration($request->all());
        $emailService->sendEmailConfirm($user->email, $user->id);
        Auth::login($user);
    }

    public function emailVerify(Request $request)
    {
        $authService = $this->authService->verifyEmail($request->all());

        if ($authService) {
            return redirect('/panel')->with(['email-verify' => 'Электронная почта успешна подтверждена']);
        }

        abort(404);
    }
}
