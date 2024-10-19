<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('dashboard',[AdminController::class,'adminDashboard'])->name('adminDashboard');
});
