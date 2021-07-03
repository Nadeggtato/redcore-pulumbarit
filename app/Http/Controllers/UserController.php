<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response as ResponseFacade;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param \App\Models\User $model
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

    public function create(CreateUserRequest $createUserRequest)
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => $createUserRequest->input('name'),
            'email' => $createUserRequest->input('email'),
            'password' => Hash::make($createUserRequest->input('password')),
        ]);

        $user->assignRole(Role::findById($createUserRequest->input('role')));
        session()->flash('success', 'User has been created!');
        return ResponseFacade::json([
            'success' => true,
            'data' => (object)[
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames(),
                'date' => $user->created_at,
            ],
        ], Response::HTTP_CREATED);
    }
}
