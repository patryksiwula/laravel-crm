<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Services\PermissionService;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::with(['roles' => function ($query) {
			$query->select('name');
		}])->paginate(15);

		return view('users.permissions.list', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-permissions');

		return view('users.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermissionRequest  $request
	 * @param  \App\Services\PermissionService  $permissionService
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request, PermissionService $permissionService)
    {
        $this->authorize('create-permissions');
        $permissionService->createPermission($request->validated('name'));

		return redirect()->route('permissions.index')
			->with('action', 'permission_created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $this->authorize('edit-permissions');

		return view('users.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionRequest  $request
     * @param  \Spatie\Permission\Models\Permission  $permission
	 * @param  \App\Services\PermissionService  $permissionService
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission, PermissionService $permissionService)
    {
        $this->authorize('edit-permissions');

        $permissionService->updatePermission(
			$permission,
			$request->validated('name'),
		);

		return redirect()->route('permissions.index')
			->with('action', 'permission_updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Permission  $Permission
	 * @param  \App\Services\PermissionService $permissionService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, PermissionService $permissionService)
    {
        $this->authorize('delete-permissions');
		$permissionService->deletePermission($permission);

		return redirect()->route('permissions.index')
			->with('action', 'permission_deleted');
    }
}
