<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;

class PermissionService
{
	/**
	 * Create a new permission
	 *
	 * @param  string $name
	 * @return \Spatie\Permission\Models\Permission
	 */
	public function createPermission(string $name): Permission
	{
		$permission = Permission::create([
			'name' => $name
		]);

		return $permission;
	}

	/**
	 * Update specified permission
	 *
	 * @param  \Spatie\Permission\Models\permission $permission
	 * @param  string $name
	 * @return \Spatie\Permission\Models\permission
	 */
	public function updatePermission(Permission $permission, string $name): Permission
	{
		if ($name !== $permission->name)
			$permission->name = $name;

		$permission->save();

		return $permission;
	}
	
	/**
	 * Delete specified permission
	 *
	 * @param  \Spatie\Permission\Models\Permission $permission
	 * @return bool
	 */
	public function deletePermission(Permission $permission): bool
	{
		foreach ($permission->roles as $role)
			$permission->removeRole($role);

		return $permission->delete();
	}
}