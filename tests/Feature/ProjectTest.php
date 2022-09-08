<?php

namespace Tests\Feature;

use App\Models\Client\Person;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectTest extends TestCase
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
				Permission::findOrCreate('create-projects'),
				Permission::findOrCreate('edit-projects'),
				Permission::findOrCreate('delete-projects')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}
    
	public function testAdminCanDisplayCreateProjectForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('projects.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateProjects(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();

		$response = $this->post(route('projects.store', [
			'name' => 'test',
			'description' => 'test',
			'deadline' => '2022-10-21',
			'search[0][model_id]' => $user->id,
			'search[1][model_id]' => $client->id,
			'search[1][model_type]' => 'App\Models\Client\Person'
		]));

		$response->assertRedirect(route('projects.index'));
	}

	public function testAdminCanUpdateProject(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();

		$project = Project::create([
			'name' => 'test',
			'description' => 'test',
			'deadline' => '2022-10-21',
			'status' => 'pending',
			'user_id' => $user->id,
			'client_type' => 'App\Models\Client\Person',
			'client_id' => $client->id
		]);

		$response = $this->from(route('projects.index'))
			->patch(route('projects.update', ['project' => $project]), [
				'name' => 'test',
				'description' => 'test',
				'deadline' => '2022-10-21',
				'status' => 'in progress',
				'search[0][model_id]' => $user->id,
				'search[1][model_id]' => $client->id,
				'search[1][model_type]' => 'App\Models\Client\Person'
			]
		);

		$response->assertRedirect(route('projects.index'));
	}

	public function testAdminCanDeleteProject(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();

		$project = Project::create([
			'name' => 'test',
			'description' => 'test',
			'deadline' => '2022-10-21',
			'status' => 'in progress',
			'user_id' => $user->id,
			'client_type' => 'App\Models\Client\Person',
			'client_id' => $client->id
		]);

		$response = $this->delete(route('projects.destroy', ['project' => $project]));

		$response->assertRedirect(route('projects.index'));
	}
}
