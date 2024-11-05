<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProfileController;

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
        Route::post('accountUpdate', [ProfileController::class, 'accountUpdate'])->name('accountUpdate');
    });

    //new admin creation
    Route::group(['prefix' => 'newAdmin', 'middleware' => 'checkSuperadmin'], function () {
        Route::get('add', [ProfileController::class, 'newAdminPage'])->name('newAdminPage');
        Route::post('add', [ProfileController::class, 'createAdminAccount'])->name('createAdminAccount');
        Route::get('list', [ProfileController::class, 'adminListPage'])->name('adminListPage');
        Route::get('delete/{id}', [ProfileController::class, 'deleteAdmin'])->name('deleteAdmin');
        Route::get('userList', [ProfileController::class, 'userListPage'])->name('userListPage');
        Route::get('user/delete/{id}', [ProfileController::class, 'deleteUser'])->name('deleteUser');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('create', [ProductController::class, 'create'])->name('createProduct');
        Route::post('store', [ProductController::class, 'store'])->name('storeProduct');
        Route::get('list', [ProductController::class, 'productListPage'])->name('productListPage');
    });
});
