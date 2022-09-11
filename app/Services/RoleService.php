<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{	
	/**
	 * Create a new role
	 *
	 * @param  array $attributes
	 * @return \Spatie\Permission\Models\Role
	 */
	public function createRole(array $attributes): Role
	{
		$role = Role::create([
			'name' => $attributes['name']
		]);

		if (!empty($attributes['permissions']))
			$role->syncPermissions($attributes['permissions']);

		return $role;
	}
	
	/**
	 * Update specified role
	 *
	 * @param  \Spatie\Permission\Models\Role $role
	 * @param  array $attributes
	 * @return \Spatie\Permission\Models\Role
	 */
	public function updateRole(Role $role, array $attributes): Role
	{
		if (!empty($attributes['permissions']))
			$role->syncPermissions($attributes['permissions']);
		else
			$role->syncPermissions([]);

		$role->update([
			'name' => $attributes['name']
		]);

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