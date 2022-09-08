<?php

namespace Tests\Feature;

use App\Models\Client\Person;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LeadTest extends TestCase
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
				Permission::findOrCreate('create-leads'),
				Permission::findOrCreate('edit-leads'),
				Permission::findOrCreate('delete-leads')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}
    
	public function testAdminCanDisplayCreateLeadForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('leads.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateLead(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();
		$product = Product::factory()->create();

		$response = $this->post(route('leads.store', [
			'name' => 'test',
			'description' => 'test',
			'source' => 'facebook',
			'lead_value' => 500000,
			'search[0][model_id]' => $user->id,
			'search[1][model_id]' => $client->id,
			'search[1][model_type]' => 'App\Models\Client\Person',
			'products[0][product_id]' => $product->id,
			'products[0][quantity]' => $product->quantity
		]));

		$response->assertRedirect(route('leads.index'));
	}

	public function testAdminCanUpdateLead(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();
		$product = Product::factory()->create();
		$lead = Lead::factory()->create();

		$response = $this->from(route('leads.index'))
			->patch(route('leads.update', ['lead' => $lead]), [
				'name' => 'test',
				'description' => 'test',
				'source' => '2022-10-21',
				'lead_value' => 500000,
				'search[0][model_id]' => $user->id,
				'search[1][model_id]' => $client->id,
				'search[1][model_type]' => 'App\Models\Client\Person',
				'products[0][product_id]' => $product->id,
				'products[0][quantity]' => $product->quantity
			]
		);

		$response->assertRedirect(route('leads.index'));
	}

	public function testAdminCanDeleteLead(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();
		$lead = Lead::factory()->create();

		$response = $this->delete(route('leads.destroy', ['lead' => $lead]));
		$response->assertRedirect(route('leads.index'));
	}
}
