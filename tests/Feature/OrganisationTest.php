<?php

namespace Tests\Feature;

use App\Models\Client\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OrganisationTest extends TestCase
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
				Permission::findOrCreate('create-clients'),
				Permission::findOrCreate('edit-clients'),
				Permission::findOrCreate('delete-clients')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}

    public function testAdminCanDisplayCreateOrganisationForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('organizations.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateOrganisation(): void
	{
		$this->actingAs(self::$admin);

		$response = $this->post(route('organizations.store', [
			'name' => 'test organisation',
			'email' => 'test@test.com',
			'phone' => '2215678221',
			'address' => 'some test address',
			'vat' => '456772661'
		]));

		$response->assertRedirect(route('organizations.index'));
	}

	public function testAdminCanDisplayEditOrganisationForm(): void
	{
		$this->actingAs(self::$admin);
		$organization = Organization::factory()->create();
		$response = $this->get(route('organizations.edit', ['organization' => $organization]));
		$response->assertOk();
	}

	public function testAdminCanDeleteOrganisation(): void
	{
		$this->actingAs(self::$admin);
		$organization = Organization::factory()->create();

		$response = $this->delete(route('organizations.destroy', ['organization' => $organization]));
		$response->assertRedirect(route('organizations.index'));
	}
}
