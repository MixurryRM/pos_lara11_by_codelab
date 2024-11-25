<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('user')->group(function () {
    Route::get('home', [UserController::class, 'userHome'])->name('userHome');
});
