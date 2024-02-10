<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Static\PageController;
use Illuminate\Support\Facades\Route;

Route::get('', [PageController::class, 'index'])->name('index');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('auth')->middleware('guest')->group(function () {
  Route::get('', [AuthController::class, 'index'])->name('auth.index');
  Route::get('sign_up', [AuthController::class, 'add'])->name('auth.add');
  Route::get('confirm/{id}', [AuthController::class, 'confirm'])->name('auth.confirm');
  Route::post('', [AuthController::class, 'login'])->name('auth.login');
  Route::post('sign_up', [AuthController::class, 'store'])->name('auth.store');
});
