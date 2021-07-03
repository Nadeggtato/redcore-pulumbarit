<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as ResponseFacade;

class RoleController extends Controller
{
    public function roleList()
    {
        return Role::all();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    public function edit(int $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
