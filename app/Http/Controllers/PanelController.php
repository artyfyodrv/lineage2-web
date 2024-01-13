<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login-page');
        }
        return view('panel.index');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
}
