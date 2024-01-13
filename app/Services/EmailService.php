<?php

namespace App\Services;

use App\Mail\ConfirmEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;

class EmailService
{
    public function sendEmailConfirm(string $address, string $userId)
    {
        $data = $this->generateUrl($userId, 'email-verify');
        Mail::to($address)->send(new ConfirmEmail($data));
    }

    private function generateUrl(int $userId, string $route, int $ttl = 1800): array
    {
        $userData = User::query()->find($userId);

        $url = URL::signedRoute($route, ['user_uuid' => $userData->uuid]);
        $data = [
            'user_id' => $userData->id,
            'user_uuid' => $userData->uuid,
            'url' => $url,
        ];
        Redis::set($userData->uuid, json_encode($data), 'ex', $ttl);

        return $data;
    }
}
