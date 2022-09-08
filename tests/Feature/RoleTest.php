<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
	/**
	 * @var \Illuminate\Contracts\Auth\Authenticatable
	 */
	private static ?User $admin = null;


	public function setUp(): void
	{
		parent::setUp();

		if (is_null(self::$admin))
		{
			$permissions = [
				Permission::findOrCreate('create-roles'),
				Permission::findOrCreate('edit-roles'),
				Permission::findOrCreate('delete-roles')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}

    public function testAdminCanDisplayCreateRoleForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('roles.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateRole(): void
	{
		$this->actingAs(self::$admin);
		$response = $this->post(route('roles.store', [
			'name' => 'test',
			'permissions' => []
		]));
		$response->assertRedirect(route('roles.index'));
	}

	public function testAdminCanDisplayEditRoleForm(): void
	{
		$this->actingAs(self::$admin);
		$role = Role::findOrCreate('test_role');
		$response = $this->get(route('roles.edit', ['role' => $role]));
		$response->assertOk();
	}

	/*public function testAdminCanUpdateRole(): void
	{
		$this->actingAs(self::$admin);
		$role = Role::findOrCreate('test_role');

		$response = $this->patch(route('roles.update', ['role' => $role], [
			'name' => 'testt',
			'permissions' => []
		]));

		$response->assertRedirect(route('roles.index'));
	}*/

	public function testAdminCanDeleteRoles(): void
	{
		$this->actingAs(self::$admin);
		$role = Role::findOrCreate('test_role');
		$response = $this->delete(route('roles.destroy', ['role' => $role]));

		$response->assertRedirect(route('roles.index'));
	}
}
