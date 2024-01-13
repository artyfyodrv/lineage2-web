<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class AuthService
{
    public function registration(array $data)
    {
        $user = new User();
        $user->fill($data);
        $user->uuid = Str::uuid()->toString();
        $user->save();
        $emailService = new EmailService();
        $emailService->sendEmailConfirm($user->email, $user->id);
    }
}
