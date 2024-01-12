<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Jobs\ConfirmEmailJob;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registration(RegisterRequest $request)
    {
        $user = new User();
        $data = $request->all();
        $user->fill($data);
        $user->save();

        ConfirmEmailJob::dispatch($request->get('email'), $request->all())->onQueue('queue-emails');
    }
}
