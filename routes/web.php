<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home1');


/*
Route::get('/auth/signin', [\App\Http\Controllers\AuthController::class, 'signin'])->name('signin');
Route::get('/auth/signup', [\App\Http\Controllers\AuthController::class, 'signup'])->name('signup');
Route::get('/auth/password-reset', [\App\Http\Controllers\AuthController::class, 'password'])->name('password');
Route::get('/auth/thanks', [\App\Http\Controllers\AuthController::class, 'thanks'])->name('thanks');
*/
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/user', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\UsersController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile', [\App\Http\Controllers\UsersController::class, 'updateProfile'])->name('profile.update');


    /**
     *
     * Services
     *
     */


    Route::get('/services', [\App\Http\Controllers\ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/create', [\App\Http\Controllers\ServicesController::class, 'create'])->name('services.create');
    Route::post('/services/store', [\App\Http\Controllers\ServicesController::class, 'store'])->name('services.store');
    Route::get('/services/edit/{id}', [\App\Http\Controllers\ServicesController::class, 'edit'])->name('services.edit');
    Route::post('/services/update/{id}', [\App\Http\Controllers\ServicesController::class, 'update'])->name('services.update');
    Route::get('/services/delete/{id}', [\App\Http\Controllers\ServicesController::class, 'destroy'])->name('services.delete');
});

/**
 * Admin routes
 */
Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    /**
     * Admin index
     */
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');

    /**
     * User routes
     */
    Route::get('/users', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
    Route::get('/users/delete/{id}', [\App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('users.delete');
    Route::any('/users/anyData', [\App\Http\Controllers\Admin\UsersController::class, 'anyData'])->name('users.anyData');


    /**
     * Category routes
     */
    Route::get('/categories', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\Admin\CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [\App\Http\Controllers\Admin\CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->name('categories.edit');
    Route::any('/categories/update/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'destroy'])->name('categories.delete');
    Route::any('/categories/anyData', [\App\Http\Controllers\Admin\CategoriesController::class, 'anyData'])->name('categories.anyData');
    Route::any('/categories/sortTable', [\App\Http\Controllers\Admin\CategoriesController::class, 'sortTable'])->name('categories.sorTable');
});
