<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{	
	/**
	 * Create a new user and assign selected role
	 *
	 * @param  string $name
	 * @param  string $email
	 * @param  string $password
	 * @param  array $roles
	 * @return \App\Models\User
	 */
	public function createUser(string $name, string $email, string $password, array $roles): User
	{
		$user = User::create([
			'name' => $name,
			'email' => $email,
			'password' => Hash::make($password),
		]);

		foreach ($roles as $role)
			Role::findById($role)->users()->attach($user);

		return $user;
	}
	
	/**
	 * Update the selected user
	 *
	 * @param  \App\Models\User $user
	 * @param  string $name
	 * @param  string $email
	 * @param  array $roles
	 * @return \App\Models\User
	 */
	public function updateUser(User $user, string $name, string $email, array $roles): User
	{
		$user->update([
			'name' => $name,
			'email' => $email
		]);

		$newRoles = [];

		foreach ($roles as $role)
			array_push($newRoles, Role::findById($role));

		$user->syncRoles($newRoles);

		return $user;
	}
}
