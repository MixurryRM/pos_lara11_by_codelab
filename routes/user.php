<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('user')->group(function () {
    Route::get('home', [UserController::class, 'userHome'])->name('userHome');
    Route::get('editPage', [UserController::class, 'editPage'])->name('userEditPage');
    Route::post('edit', [UserController::class, 'edit'])->name('userEdit');
    Route::get('changePasswordPage', [UserController::class, 'changePasswordPage'])->name('userChangePasswordPage');
    Route::post('changePassword', [UserController::class, 'changePassword'])->name('userChangePassword');
});
