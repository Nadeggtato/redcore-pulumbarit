<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

    public function showUpdateForm(int $id)
    {
        /** @var User $user */
        $user = User::with('roles')->find($id);

        return view('users.update', compact('user'));
    }

    public function update(UpdateUserRequest $updateUserRequest)
    {
        $fieldsToUpdate = [
            'name' => $updateUserRequest->input('name'),
            'email' => $updateUserRequest->input('email'),
        ];

        if ($updateUserRequest->input('password') !== '') {
            $fieldsToUpdate['password'] = Hash::make($updateUserRequest->input('password'));
        }

        /** @var User $user */
        $user = User::find($updateUserRequest->input('id'));
        $user->update($fieldsToUpdate);

        $user->removeRole($user->roles()->first());
        $user->assignRole(Role::findById($updateUserRequest->input('role')));

        return ResponseFacade::json([
            'success' => true,
            'data' => (object)[
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames(),
                'date' => $user->created_at,
            ],
        ], Response::HTTP_OK);

    }
}
