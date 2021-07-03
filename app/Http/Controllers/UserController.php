<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function show(User $model)
    {
        return view('users.index');
    }

    public function userList()
    {
        return User::with('roles')->get();
    }
}
