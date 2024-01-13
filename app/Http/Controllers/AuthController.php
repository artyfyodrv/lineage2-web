<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registration(RegisterRequest $request)
    {
        $authService = new AuthService();
        $authService->registration($request->all());
    }

    public function emailVerify(Request $request)
    {
        $verifyData = Redis::get($request->user_uuid);
        $userData = User::query()->where('uuid', $request->user_uuid)->first();

        if ($verifyData && !$userData->email_verify) {
            Redis::del($request->user_uuid);
            $userData->email_verify = true;
            $userData->email_verified_at = now();
            $userData->save();
            dd('Вы успешно подтвердили аккаунт!');
        } else {
            echo 'Ваш аккаунт уже был подтверждён!';
        }
    }
}
