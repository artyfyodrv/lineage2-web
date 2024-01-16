<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Services\PanelService;
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

    public function changePassword(ChangePasswordRequest $request, PanelService $panelService)
    {
        $check = $panelService->changePassword($request->all(), Auth::user());

        return redirect()->back()->withErrors($check);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
}
