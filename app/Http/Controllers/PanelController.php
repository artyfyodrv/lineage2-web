<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login-page');
        }
        return view('panel.index');
    }

    public function changePasswordPage()
    {
        return view('panel.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if ($data['current_email'] !== $user['email']) {
            return redirect()->back()->withErrors(['current_email' => 'Введена неверная электронная почта']);
        }

        if (Hash::check($data['current_password'], $user['password'])) {
            $user['password'] = Hash::make($data['new_password']);
            $user->save();
            return redirect()->back()->with('message-change', 'Пароль успешно изменен');
        }

        return redirect()->back()->withErrors(['current_password' => 'Введен неверный пароль']);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
}
