<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\DeleteRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as ResponseFacade;

class RoleController extends Controller
{
    public function index()
    {
        if (auth('web')->user()->cannot('viewAny', Role::class)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('roles.index');
    }

    public function roleList()
    {
        return Role::all();
    }

    public function showCreateForm()
    {
        if (auth('web')->user()->cannot('create', User::class)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('roles.create');
    }

    public function create(CreateRoleRequest $createRoleRequest)
    {
        /** @var Role $role */
        $role = Role::query()->create([
            'name' => $createRoleRequest->input('name'),
            'description' => $createRoleRequest->input('description'),
        ]);

        return ResponseFacade::json([
            'success' => true,
            'data' => (object)[
                'name' => $role->name,
                'description' => $role->description,
                'date' => $role->created_at,
            ],
        ], Response::HTTP_CREATED);
    }

    public function edit(int $id)
    {
        if (auth('web')->user()->cannot('update', Role::find($id))) {
            abort(Response::HTTP_FORBIDDEN);
        }
        $role = Role::findById($id);

        return view('roles.update', compact('role'));
    }

    public function update(UpdateRoleRequest $updateRoleRequest)
    {
        /** @var Role $role */
        $role = Role::query()->find($updateRoleRequest->input('id'));
        $role->update([
            'name' => $updateRoleRequest->input('name'),
            'description' => $updateRoleRequest->input('description'),
        ]);

        return ResponseFacade::json([
            'success' => true,
            'date' => Carbon::now(),
        ]);
    }

    public function destroy(DeleteRoleRequest $deleteRoleRequest)
    {
        if (Role::query()->count() === 1) {
            return ResponseFacade::json([
                'success' => false,
                'error' => 'Unable to delete the last role.',
            ], Response::HTTP_FORBIDDEN);
        }

        /** @var Role $role */
        $role = Role::find($deleteRoleRequest->input('id'));
        if ($role->name === Role::SUPER_ADMIN) {
            return ResponseFacade::json([
                'success' => false,
                'error' => 'Unable to delete super admin role',
            ], Response::HTTP_FORBIDDEN);
        }

        $role->delete();
        session()->flash('success', 'Role has been deleted!');

        return ResponseFacade::json([
            'success' => true,
            'data' => (object)[
                'id' => $role->id,
                'date' => Carbon::now(),
            ],
        ]);
    }
}
