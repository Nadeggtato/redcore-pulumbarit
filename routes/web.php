<?php

use App\Http\Controllers\HomeController;
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
    Route::view('users/create', 'users.create')->name('user.create.form');
    Route::post('users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('users/update/{id}', [UserController::class, 'edit'])->name('user.update.form');
    Route::put('users/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/delete', [UserController::class, 'delete'])->name('user.delete');

    Route::view('roles', 'roles.index')->name('role.index');
    Route::get('roles/list', [RoleController::class, 'roleList'])->name('role.list');
    Route::view('roles/create', 'roles.create')->name('role.create.form');
    Route::post('roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::get('roles/update/{id}', [RoleController::class, 'edit'])->name('role.update.form');
    Route::put('roles/update', [RoleController::class, 'update'])->name('role.update');

    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
    Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
    Route::get('notifications',
        ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
    Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
    Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password',
        ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

