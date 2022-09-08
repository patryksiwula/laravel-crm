<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
	/**
	 * @var \Illuminate\Contracts\Auth\Authenticatable
	 */
	private static ?User $user1 = null;

	/**
	 * @var \Illuminate\Contracts\Auth\Authenticatable
	 */
	private static ?User $user2 = null;

	/**
	 * @var \Illuminate\Contracts\Auth\Authenticatable
	 */
	private static ?User $admin = null;

	public function setUp(): void
	{
		parent::setUp();

		if (is_null(self::$user1))
		{
			$permissions = [
				Permission::findOrCreate('create-users'),
				Permission::findOrCreate('edit-users'),
				Permission::findOrCreate('delete-users')
			];

			$roleManager = Role::findOrCreate('manager');
			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);

			self::$user1 = User::factory()->create();
			self::$user2 = User::factory()->create();
			self::$admin = User::factory()->create();

			self::$user1->assignRole($roleManager);
			self::$user2->assignRole($roleManager);
			self::$admin->assignRole($roleAdmin);
		}
	}

    public function testUserListCanBeRendered(): void
    {
		$this->actingAs(self::$user1);
        $response = $this->get(route('users.index'));
        $response->assertOk();
    }

	public function testUserCannotDisplayCreateUserForm(): void
	{
		$this->actingAs(self::$user1);
        $response = $this->get(route('users.create'));
        $response->assertForbidden();
	}

	public function testAdminCanDisplayCreateUserForm(): void
	{
		$this->actingAs(self::$admin);
        $response = $this->get(route('users.create'));
        $response->assertOk();
	}

	public function testUserCannotCreateUser(): void
	{
		$this->actingAs(self::$user1);

        $response = $this->post(route('users.store', [
			'name' => 'Test user',
			'email' => 'test@email.com',
			'password' => 'password',
			'password_confirmation' => 'password',
			'roles' => [1]
		]));

        $response->assertForbidden();
	}

	public function testAdminCanCreateUser(): void
	{
		$this->actingAs(self::$admin);

        $response = $this->post(route('users.store', [
			'name' => 'Test user',
			'email' => 'test@email.com',
			'password' => 'password',
			'password_confirmation' => 'password',
			'roles' => [1]
		]));

        $response->assertRedirect(route('users.index'));
	}

	public function testAdminCanDeleteUser(): void
	{
		$this->actingAs(self::$admin);
		
		$response = $this->delete(route('users.destroy', ['user' => self::$user2]));
		$response->assertRedirect(route('users.index'));
	}
}
