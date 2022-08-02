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
	 * @param  int $role
	 * @return \App\Models\User
	 */
	public function createUser(string $name, string $email, string $password, int $role): User
	{
		$user = User::create([
			'name' => $name,
			'email' => $email,
			'password' => Hash::make($password),
		]);

		Role::findById($role)->users()
			->attach($user);

		return $user;
	}
	
	/**
	 * Update the selected user
	 *
	 * @param  \App\Models\User $user
	 * @param  string $name
	 * @param  string $email
	 * @param  int $role
	 * @return \App\Models\User
	 */
	public function updateUser(User $user, string $name, string $email, int $role): User
	{
		$user->update([
			'name' => $name,
			'email' => $email
		]);

		$user->syncRoles(Role::findById($role));

		return $user;
	}
}
