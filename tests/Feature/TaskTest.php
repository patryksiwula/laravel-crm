<?php

namespace Tests\Feature;

use App\Models\Client\Person;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TaskTest extends TestCase
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
				Permission::findOrCreate('create-tasks'),
				Permission::findOrCreate('edit-tasks'),
				Permission::findOrCreate('delete-tasks')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}
    
	public function testAdminCanDisplayCreateTaskForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateTask(): void
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

		$response = $this->post(route('tasks.store', [
			'name' => 'test',
			'description' => 'test',
			'deadline' => '2022-10-21',
			'search[0][model_id]' => $user->id,
			'search[1][model_id]' => $project->id,
		]));

		$response->assertRedirect(route('tasks.index'));
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

		$task = Task::create([
			'name' => 'test',
			'description' => 'test',
			'deadline' => '2022-10-21',
			'user_id' => $user->id,
			'project_id' => $project->id
		]);

		$response = $this->from(route('tasks.index'))
			->patch(route('tasks.update', ['task' => $task]), [
				'name' => 'test',
				'description' => 'test',
				'deadline' => '2022-10-21',
				'search[0][model_id]' => $user->id,
				'search[1][model_id]' => $project->id,
			]
		);

		$response->assertRedirect(route('tasks.index'));
	}

	public function testAdminCanDeleteTask(): void
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

		$task = Task::create([
			'name' => 'test',
			'description' => 'test',
			'deadline' => '2022-10-21',
			'user_id' => $user->id,
			'project_id' => $project->id
		]);

		$response = $this->delete(route('tasks.destroy', ['task' => $task]));

		$response->assertRedirect(route('tasks.index'));
	}
}
