<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client\Organization;
use App\Models\Client\Person;
use App\Models\Product;
use App\Models\User;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$admin = User::create([
			'name' => 'Test Admin',
			'email' => 'admin@admin.com',
			'password' => Hash::make('admin')
		]);

		$manager = User::create([
			'name' => 'Test Manager',
			'email' => 'manager@manager.com',
			'password' => Hash::make('manager')
		]);

		$this->createPermissions();

		$adminRole = Role::create(['name' => 'admin']);
		$managerRole = Role::create(['name' => 'manager']);

		$adminRole->givePermissionTo(Permission::all());
		$managerRole->givePermissionTo(Permission::all());
		$managerRole->revokePermissionTo('create-users');
		$managerRole->revokePermissionTo('edit-users');
		$managerRole->revokePermissionTo('delete-users');

		$admin->assignRole('admin');
		$manager->assignRole('manager');

        Organization::factory(30)->create();
		Person::factory(30)->create();
		Product::factory(10)->create();
		Lead::factory(10)->create();
		Project::factory(10)->create();
		Task::factory(20)->create();
		Meeting::factory(5)->create();
    }

	public function createPermissions(): void
	{
		Permission::create(['name' => 'create-users']);
		Permission::create(['name' => 'edit-users']);
		Permission::create(['name' => 'delete-users']);

		Permission::create(['name' => 'create-permissions']);
		Permission::create(['name' => 'edit-permissions']);
		Permission::create(['name' => 'delete-permissions']);

		Permission::create(['name' => 'create-roles']);
		Permission::create(['name' => 'edit-roles']);
		Permission::create(['name' => 'delete-roles']);

		Permission::create(['name' => 'create-clients']);
		Permission::create(['name' => 'edit-clients']);
		Permission::create(['name' => 'delete-clients']);

		Permission::create(['name' => 'create-leads']);
		Permission::create(['name' => 'edit-leads']);
		Permission::create(['name' => 'delete-leads']);

		Permission::create(['name' => 'create-invoices']);
		Permission::create(['name' => 'edit-invoices']);
		Permission::create(['name' => 'delete-invoices']);

		Permission::create(['name' => 'create-products']);
		Permission::create(['name' => 'edit-products']);
		Permission::create(['name' => 'delete-products']);

		Permission::create(['name' => 'create-documents']);
		Permission::create(['name' => 'delete-documents']);

		Permission::create(['name' => 'create-projects']);
		Permission::create(['name' => 'edit-projects']);
		Permission::create(['name' => 'delete-projects']);

		Permission::create(['name' => 'create-tasks']);
		Permission::create(['name' => 'edit-tasks']);
		Permission::create(['name' => 'delete-tasks']);

		Permission::create(['name' => 'create-meetings']);
		Permission::create(['name' => 'edit-meetings']);
		Permission::create(['name' => 'delete-meetings']);

		Permission::create(['name' => 'edit-configs']);
	}
}
