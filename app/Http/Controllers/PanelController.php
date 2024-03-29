<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PanelController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login-page');
        }
        return view('panel.index');
    }

    public function changePasswordPage(): View
    {
        return view('panel.change-password');
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $request = $request->all();
        $user = Auth::user();

        if ($request['current_email'] !== $user['email']) {
            return redirect()->back()->withErrors(['message-change' => 'Введена неверная почта']);
        }

        if (!Hash::check($request['current_password'], $user['password'])) {
            return redirect()->back()->withErrors(['message-change' => 'Введен неверный пароль']);
        }

        $user['password'] = Hash::make($request['new_password']);
        $user->save();


        return redirect()->back()->with(['message-change' => 'Пароль успешно изменен']);
    }

    public function changeEmailPage(): View
    {
        return view('panel.change-email');
    }


    public function changeEmail(ChangeEmailRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($request->get('current_email') !== $user['email']) {
            return redirect()->back()->withErrors(['message-change' => 'Введена неверная почта']);
        }

        $user['email'] = $request->get('new_email');
        $user->save();

        return redirect()->back()->with(['message-change' => 'Почта успешно изменена']);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
}
