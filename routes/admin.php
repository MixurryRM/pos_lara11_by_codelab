<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::prefix('admin')->middleware('admin')->group(function () {
//     Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
// });

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('list', [CategoryController::class, 'list'])->name('categoryList');
        Route::post('create', [CategoryController::class, 'create'])->name('categoryCreate');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete');
        Route::get('updatePage/{id}', [CategoryController::class, 'updatePage'])->name('updatePage');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('categoryUpdate');
    });

    //profile
    Route::group(['prefix' => 'profile'], function () {

        Route::get('changePassword', [ProfileController::class, 'changePasswordPage'])->name('changePasswordPage');
        Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('changePassword');
        Route::get('accountProfile', [ProfileController::class, 'accountProfile'])->name('accountProfile');
        Route::get('accountEdit', [ProfileController::class, 'accountEdit'])->name('accountEdit');
    });
});
