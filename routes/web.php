<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('register-page');
    Route::post('register', [AuthController::class, 'registration'])->name('register-form');
    Route::get('email-verify', [AuthController::class, 'emailVerify'])->name('email-verify');
    Route::get('login', [AuthController::class, 'login'])->name('login-page');
    Route::post('auth', [AuthController::class, 'auth'])->name('login-form');
});

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel-page');
    Route::get('change-password', [PanelController::class, 'changePasswordPage'])->name('change-password-page');
    Route::post('change-password', [PanelController::class, 'changePassword'])->name('change-password');
    Route::get('change-email', [PanelController::class, 'changeEmailPage'])->name('change-email-page');
    Route::post('change-email', [PanelController::class, 'changeEmail'])->name('change-email');
    Route::get('logout', [PanelController::class, 'logout'])->name('logout');
});
