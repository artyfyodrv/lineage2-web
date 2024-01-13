<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class AuthService
{
    public function registration(array $data)
    {
        $user = new User();
        $user->fill($data);
        $user->uuid = Str::uuid()->toString();
        $user->save();

        return $user;
    }

    public function verifyEmail(array $request)
    {
        $verifyData = Redis::get($request['user_uuid']);
        $user = User::query()->where('uuid', $request['user_uuid'])->first();

        if ($verifyData && !$user->email_verify) {
            Redis::del($request['user_uuid']);
            $user->email_verify = true;
            $user->email_verified_at = now();

            return $user->save();
        }

        return false;
    }
}
