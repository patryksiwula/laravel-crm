<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{	
	/**
	 * Create a new role
	 *
	 * @param  string $name
	 * @param  ?array $permissions
	 * @return \Spatie\Permission\Models\Role
	 */
	public function createRole(string $name, ?array $permissions = []): Role
	{
		$role = Role::create([
			'name' => $name
		]);

		if (!empty($permissions))
			$role->syncPermissions($permissions);

		return $role;
	}
	
	/**
	 * Update specified role
	 *
	 * @param  \Spatie\Permission\Models\Role $role
	 * @param  string $name
	 * @param  array $permissions
	 * @return \Spatie\Permission\Models\Role
	 */
	public function updateRole(Role $role, string $name, array $permissions): Role
	{
		if ($name !== $role->name)
			$role->name = $name;

		$role->syncPermissions($permissions)
			->save();

		return $role;
	}
	
	/**
	 * Delete specified role
	 *
	 * @param  \Spatie\Permission\Models\Role $role
	 * @return bool
	 */
	public function deleteRole(Role $role): bool
	{
		foreach ($role->permissions as $permission)
			$role->revokePermissionTo($permission);

		foreach ($role->users as $user)
			$user->removeRole($role);

		return $role->delete();
	}
}