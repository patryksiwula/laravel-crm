<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-users']);
		Permission::create(['name' => 'edit-users']);
		Permission::create(['name' => 'delete-users']);

		Permission::create(['name' => 'create-clients']);
		Permission::create(['name' => 'edit-clients']);
		Permission::create(['name' => 'delete-clients']);

		$admin = Role::findByName('admin');
		$manager = Role::findByName('manager');

		$admin->givePermissionTo(Permission::all());
		$manager->givePermissionTo(['create-clients', 'edit-clients', 'delete-clients']);
    }
}
