<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route::prefix('admin')->middleware('admin')->group(function () {
//     Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
// });

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
});
