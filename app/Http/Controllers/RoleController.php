<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with(['permissions' => function ($query) {
			$query->select('name');
		}])->paginate(15);

		return view('users.roles.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
		$this->authorize('create-users');
        $permissions = Permission::all();

		return view('users.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
	 * @param  \App\Services\RoleService $roleService
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request, RoleService $roleService)
    {	
		$this->authorize('create-users');

        $roleService->createRole(
			$request->validated('name'),
			$request->validated('permissions')
		);

		return redirect()->route('roles.index')
			->with('action', 'role_created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('edit-users');
		$permissions = Permission::all();

		return view('users.roles.edit', [
			'role' => $role,
			'permissions' => $permissions
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
	 * @param  \App\Services\RoleService $roleService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role, RoleService $roleService): RedirectResponse
    {
		$this->authorize('edit-users');

        $roleService->updateRole(
			$role,
			$request->validated('name'),
			$request->validated('permissions')
		);

		return redirect()->route('roles.index')
			->with('action', 'role_updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, RoleService $roleService)
    {
        $this->authorize('delete-users');
		$roleService->deleteRole($role);

		return redirect()->route('roles.index')
			->with('action', 'role_deleted');
    }
}
