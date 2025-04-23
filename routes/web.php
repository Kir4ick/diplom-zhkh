<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');

Route::get('/sign-up', [\App\Http\Controllers\IndexController::class, 'register'])->name('sign-up');
Route::get('/sign-in', [\App\Http\Controllers\IndexController::class, 'login'])->name('sign-in');

Route::post('/sign-up', [\App\Http\Controllers\IndexController::class, 'registration'])->name('sign-up.action');
Route::post('/sign-in', [\App\Http\Controllers\IndexController::class, 'authorize'])->name('sign-in.action');

Route::get('/feedback', [\App\Http\Controllers\IndexController::class, 'feedbackPage'])->name('feedback');
Route::post('/feedback', [\App\Http\Controllers\IndexController::class, 'feedback'])->name('feedback.action');

Route::get('/request', [\App\Http\Controllers\IndexController::class, 'request'])->name('request');
Route::post('/request', [\App\Http\Controllers\IndexController::class, 'requestAction'])->name('request.action');

Route::get('/lk', [\App\Http\Controllers\IndexController::class, 'lk'])->name('lk');
Route::put('/update', [\App\Http\Controllers\IndexController::class, 'profileUpdate'])->name('profile.update');

Route::get('/logout', [\App\Http\Controllers\IndexController::class, 'logout'])->name('logout');
