<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class PanelService
{
    public function changePassword($data, $user)
    {
        if ($data['current_email'] !== $user['email']) {
            return ['message-change' => 'Введена неверная почта'];
        }

        if (!Hash::check($data['current_password'], $user['password'])) {
            return ['message-change' => 'Введен неверный пароль'];
        }

        $user['password'] = Hash::make($data['new_password']);
        $user->save();

        return ['message-change' => 'Пароль успешно изменен'];
    }
}
