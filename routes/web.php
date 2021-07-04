<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::view('users', 'users.index')->name('user.show');
    Route::get('users/list', [UserController::class, 'userList'])->name('user.list');
    Route::get('users/create', [UserController::class, 'showCreateForm'])->name('user.create.form');
    Route::post('users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('users/update/{id}', [UserController::class, 'edit'])->name('user.update.form');
    Route::put('users/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/delete', [UserController::class, 'delete'])->name('user.delete');

    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('roles/list', [RoleController::class, 'roleList'])->name('role.list');
    Route::get('roles/create', [RoleController::class, 'showCreateForm'])->name('role.create.form');
    Route::post('roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::get('roles/update/{id}', [RoleController::class, 'edit'])->name('role.update.form');
    Route::put('roles/update', [RoleController::class, 'update'])->name('role.update');
    Route::delete('roles/delete', [RoleController::class, 'destroy'])->name('role.delete');

    Route::get('permissions', [PermissionController::class, 'list']);
});

