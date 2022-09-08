<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductTest extends TestCase
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
				Permission::findOrCreate('create-products'),
				Permission::findOrCreate('edit-products'),
				Permission::findOrCreate('delete-products')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}

    public function testAdminCanDisplayCreateProductForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('products.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateProduct(): void
	{
		$this->actingAs(self::$admin);

		$response = $this->post(route('products.store', [
			'name' => 'test product',
			'description' => 'test',
			'price' => 0,
			'quantity' => 2
		]));

		$response->assertRedirect(route('products.index'));
	}

	public function testAdminCanDisplayEditProductForm(): void
	{
		$this->actingAs(self::$admin);
		$product = Product::factory()->create();

		$response = $this->get(route('products.edit', ['product' => $product]));
		$response->assertOk();
	}

	public function testAdminCanDeleteProducts(): void
	{
		$this->actingAs(self::$admin);
		$product = Product::factory()->create();

		$response = $this->delete(route('products.destroy', ['product' => $product]));
		$response->assertRedirect(route('products.index'));
	}
}
